<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use App\Entities\Ujian;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use CodeIgniter\API\ResponseTrait;


class UjianController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model        = model('App\Models\UjianModel');
        $this->session = session();
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['waktu'] = Time::parse($data['waktu']);
        $data['waktu'] = $data['waktu']->toDateTimeString();
        $item = new Ujian($data);
        $item->setToken();
        if ($this->model->save($item)) {
            return redirect()->route('ujian-data')->with('message', 'Jadwal Ujian Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {

        if ($this->model->delete($id)) {
            return redirect()->route('ujian-data')->with('message', 'Data telah berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();
        $item = $this->model->find($id);
        $item->fill($data);
        if ($item->hasChanged()) {
            if ($this->model->save($item)) {
                return redirect()->route('ujian-data')->with('message', 'Data telah berhasil diedit');
            }
        }
    }

    public function download()
    {
        $soal = [];
        $data = $this->request->getPost();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('CBT')
            ->setLastModifiedBy('SIPK')
            ->setTitle("Soal CBT")
            ->setSubject("Soal CBT")
            ->setDescription("Format untuk import soal di CBT")
            ->setKeywords('soal php cbt')
            ->setCategory('Template');

        $spreadsheet->setActiveSheetIndex(0);
        if ($data['tipe'] == 'pilgan1') {
            $spreadsheet->getActiveSheet()->setCellValue('A1', 'nomor')
                ->setCellValue('B1', 'tipe')
                ->setCellValue('C1', 'soal')
                ->setCellValue('D1', 'benar')
                ->setCellValue('E1', 'salah1')
                ->setCellValue('F1', 'salah2')
                ->setCellValue('G1', 'salah3');
            for ($i = 1; $i <= $data['jumlah']; $i++) {
                $absen[] = [
                    $i, 'pilgan1', '', '', '', '',
                ];
            }
        } else {
            $spreadsheet->getActiveSheet()->setCellValue('A1', 'nomor')
                ->setCellValue('B1', 'tipe')
                ->setCellValue('C1', 'soal')
                ->setCellValue('D1', 'benar')
                ->setCellValue('E1', 'salah1')
                ->setCellValue('F1', 'salah2')
                ->setCellValue('G1', 'salah3')
                ->setCellValue('H1', 'salah4');
            for ($i = 1; $i <= $data['jumlah']; $i++) {
                $absen[] = [
                    $i, 'pilgan2', '', '', '', '', '',
                ];
            }
        }

        $spreadsheet->getActiveSheet()->fromArray($absen, null, 'A2');

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setAutoFilter($spreadsheet->getActiveSheet()->calculateWorksheetDimension());

        ob_clean();
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('soal.xlsx') . '"');
        $writer->save('php://output');
        exit();
    }

    public function upload()
    {
        $name = time();
        $this->session->set('soal_id', $name);
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
            if (file_exists(WRITEPATH . "uploads/$name.xlsx")) {
                unlink(WRITEPATH . "uploads/$name.xlsx");
            }
            $file->move(WRITEPATH . "uploads", "$name." . $file->getClientExtension());
            return $this->respond(['berhasil' => true], 200);
        }
        return $this->fail($file->getError(), 400);
    }

    public function save()
    {
        $post = $this->request->getPost();
        if (!$this->session->soal_id || !file_exists(WRITEPATH . "uploads/{$this->session->soal_id}.xlsx")) {
            return redirect()->back()->with('error', 'Anda Belum mengupload file soal');
        }
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(WRITEPATH . "uploads/{$this->session->soal_id}.xlsx");
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

        $item = $this->model->find($post['id']);
        $item->status = 1;
        foreach ($data as $k => $v) {
            $temp = $v;
            unset($temp['nomor']);
            unset($temp['tipe']);
            unset($temp['soal']);
            $num = 1;
            foreach ($temp as $keyyy => $abc) {
                $valid = $keyyy == 'benar' ? true : false;
                $data[$k]['pilihan'][] = [
                    'id' => $num++,
                    'text' => $abc,
                    'valid' => $valid,
                ];
                unset($data[$k][$keyyy]);
            }
        }
        $item->soal_pilgan = $data;
        // dd($this->session->soal_id, $post, $data, $item);
        if ($item->hasChanged()) {
            $this->model->save($item);
            unlink(WRITEPATH . "uploads/{$this->session->soal_id}.xlsx");
            $this->session->remove('soal_id');
            return redirect()->route('ujian-atur')->with('message', 'Berhasil Upload Soal');
        }
        return redirect()->route('ujian-atur')->with('error', 'Gagal Upload Soal');
    }
}