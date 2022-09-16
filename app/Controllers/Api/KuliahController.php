<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Kuliah;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\API\ResponseTrait;


class KuliahController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model        = model('App\Models\KuliahModel');
        $this->mahasiswa         = model('App\Models\MahasiswaModel');
        $this->matkul         = model('App\Models\MatkulModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'mahasiswa_id' => 'required',
            'matakuliah_id' => 'required',
            'tahun' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Kuliah($data);
        if ($this->model->save($item)) {
            return redirect()->route('data-kuliah')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {

        if ($this->model->delete($id)) {
            return redirect()->route('data-kuliah')->with('message', 'Data telah berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        // validation rules
        $Rules = [
            'mahasiswa_id' => 'required',
            'matakuliah_id' => 'required',
            'tahun' => 'required',

        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Kuliah($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-kuliah')->with('message', 'Data Baru telah berhasil diedit');
        }
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator('CBT')
            ->setLastModifiedBy('CBT')
            ->setTitle("CBT Kuliah")
            ->setSubject("CBT Kuliah")
            ->setDescription("Format untuk import Kuliah di CBT pada")
            ->setKeywords('Kuliah php CBT')
            ->setCategory('Template');

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'nim')
            ->setCellValue('B1', 'kode_matkul')
            ->setCellValue('C1', 'tahun');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('dataKuliah.xlsx') . '"');
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
            if (file_exists(WRITEPATH . 'uploads/dataKuliah.xlsx')) {
                unlink(WRITEPATH . 'uploads/dataKuliah.xlsx');
            }
            $file->move(WRITEPATH . 'uploads', 'dataKuliah.' . $file->getClientExtension());
            return $this->respond(['berhasil' => true], 200);
        }
        return $this->fail($file->getError(), 400);
    }

    public function saveExcel()
    {
        if (!file_exists(WRITEPATH . 'uploads/dataKuliah.xlsx')) {
            return redirect()->back()->with('error', 'Anda Belum mengupload file');
        }
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(WRITEPATH . 'uploads/dataKuliah.xlsx');
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

            $kuliah = new Kuliah($item);
            // dd($mhs);
            $mhs = $this->mahasiswa->where('nim', $kuliah->nim)->first();
            $matkul = $this->matkul->where('kode', $kuliah->kode_matkul)->first();
            if ($mhs && $matkul) {
                $kuliah->mahasiswa_id = $mhs->id;
                $kuliah->matakuliah_id = $matkul->id;
                $this->model->save($kuliah);
            }
        }
        unlink(WRITEPATH . 'uploads/dataKuliah.xlsx');
        return redirect()->route('data-kuliah')->with('message', 'Data Kuliah Berhasil Di Import');
    }
}
