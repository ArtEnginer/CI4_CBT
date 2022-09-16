<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Matkul;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\API\ResponseTrait;

class MatkulController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model        = model('App\Models\MatkulModel');
        $this->dosen         = model('App\Models\DosenModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'sks' => 'required|less_than[5]',
            'nama' => 'required|min_length[3]|max_length[50]',
            'semester' => 'required|numeric',
            // 'ruang_id' => 'required|numeric',
            'dosen_id' => 'required|numeric',
            'kode' => 'required|is_unique[cbt_matakuliah.kode]',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Matkul($data);
        if ($this->model->save($item)) {
            return redirect()->route('data-matkul')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            return redirect()->route('data-matkul')->with('message', 'Data telah berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();
        $Rules = [
            'sks' => 'required|numeric|less_than[5]',
            'nama' => 'required|min_length[3]|max_length[50]',
            'semester' => 'required|numeric',
            // 'ruang_id' => 'required|numeric',
            'dosen_id' => 'required|numeric',
            'kode' => 'required|is_unique[cbt_matakul.kode,id,' . $id . ']',
        ];
        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Matkul($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-matkul')->with('message', 'Data Baru telah berhasil diedit');
        }
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator('CBT')
            ->setLastModifiedBy('CBT')
            ->setTitle("CBT Matkul")
            ->setSubject("CBT Matkul")
            ->setDescription("Format untuk import Matkul di CBT pada")
            ->setKeywords('Matkul php CBT')
            ->setCategory('Template');

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'nama')
            ->setCellValue('B1', 'sks')
            ->setCellValue('C1', 'semester')
            ->setCellValue('D1', 'nidn_dosen')
            ->setCellValue('E1', 'kode');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('dataMatkul.xlsx') . '"');
        $writer->save('php://output');
        exit();
    }

    public function upload()
    {
        if (!$this->validate([
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa Xls atau Xlsx',
                ]
            ]
        ])) {
            return $this->fail($this->validator->getErrors(), 400);
        }
        $file = $this->request->getFile('file');


        if ($file->isValid() && !$file->hasMoved()) {
            if (file_exists(WRITEPATH . 'uploads/dataMatkul.xlsx')) {
                unlink(WRITEPATH . 'uploads/dataMatkul.xlsx');
            }
            $file->move(WRITEPATH . 'uploads', 'dataMatkul.' . $file->getClientExtension());
            return $this->respond(['berhasil' => true], 200);
        }
        return $this->fail($file->getError(), 400);
    }

    public function saveExcel()
    {
        if (!file_exists(WRITEPATH . 'uploads/dataMatkul.xlsx')) {
            return redirect()->back()->with('error', 'Anda Belum mengupload file');
        }
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(WRITEPATH . 'uploads/dataMatkul.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        $keys = [];

        foreach ($worksheet->getRowIterator() as $row) {
            // (C1) FETCH DATA FROM WORKSHEET
            $cellIterator = $row->getCellIterator();
            $indexis = $row->getRowIndex();
            $cellIterator->setIterateOnlyExistingCells(false);
            $baris = [];
            if ($indexis == 1) {
                foreach ($cellIterator as $key => $cell) {
                    $keys[$key] = $cell->getValue();
                }
            } else {
                foreach ($cellIterator as $key => $cell) {
                    $baris[$keys[$key]] = $cell->getValue();
                }
                $data[] = $baris;
            }
        }

        // (D2) INSERT DATA INTO DATABASE 
        foreach ($data as $item) {
            $matkul = new Matkul($item);
            $dosen = $this->dosen->where('nip', $item['nidn_dosen'])->first();
            if ($dosen) {
                $matkul->dosen_id = $dosen->id;
                $this->model->save($matkul);
            } else {
                return redirect()->back()->with('error', 'Data pada baris tidak bisa diimport karena dosen dengan NIDN ' . $item['nidn_dosen'] . ' tidak ditemukan');
            }
        }
        unlink(WRITEPATH . 'uploads/dataMatkul.xlsx');
        return redirect()->route('data-matkul')->with('message', 'Data Mata Kuliah Berhasil Di Import');
    }
}
