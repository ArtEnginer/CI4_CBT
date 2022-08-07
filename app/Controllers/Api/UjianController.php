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

        if ($data['jumlah'] < 1 && $data['jumlah_essay'] < 1) {
            return redirect()->back()->with('error', 'Soal Tidak Boleh kosong');
        }

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
            if ($data['jumlah'] > 0) {
                for ($i = 1; $i <= $data['jumlah']; $i++) {
                    $soal[] = [
                        $i, 'pilgan1', '', '', '', '',
                    ];
                }
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
            if ($data['jumlah'] > 0) {
                for ($i = 1; $i <= $data['jumlah']; $i++) {
                    $soal[] = [
                        $i, 'pilgan2', '', '', '', '', '',
                    ];
                }
            }
        }
        if ($data['jumlah_essay'] > 0) {
            for ($i = 1; $i <= $data['jumlah_essay']; $i++) {
                $soal[] = [
                    $i, 'essay', '', '', '', '', '',
                ];
            }
        }
        $spreadsheet->getActiveSheet()->fromArray($soal, null, 'A2');

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
        $pilgan = [];
        $essay = [];
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
            if ($v['tipe'] == 'essay') {
                unset($temp['nomor']);
                unset($temp['tipe']);
                unset($temp['soal']);
                foreach ($temp as $keyyy => $abc) {
                    unset($v[$keyyy]);
                }
                $v['img'] = '';
                $essay[] = $v;
            } else {
                unset($temp['nomor']);
                unset($temp['tipe']);
                unset($temp['soal']);
                foreach ($temp as $keyyy => $abc) {
                    $valid = $keyyy == 'benar' ? true : false;
                    $v['pilihan'][] = [
                        'id' => strtoupper(bin2hex(random_bytes(4))),
                        'text' => $abc,
                        'valid' => $valid,
                    ];
                    unset($v[$keyyy]);
                }
                $v['img'] = '';
                $pilgan[] = $v;
            }
        }
        if (empty($pilgan) && empty($essay)) {
            return redirect()->back()->with('error', 'Soal Tidak Boleh kosong');
        }
        if ($pilgan) {
            $item->soal_pilgan = $pilgan;
        }
        if ($essay) {
            $item->soal_essay = $essay;
        }
        // dd($this->session->soal_id, $post, $data, $item,$pilgan, $essay);
        if ($item->hasChanged()) {
            $this->model->save($item);
            unlink(WRITEPATH . "uploads/{$this->session->soal_id}.xlsx");
            $this->session->remove('soal_id');
            return redirect()->route('ujian-atur')->with('message', 'Berhasil Upload Soal');
        }
        return redirect()->route('ujian-atur')->with('error', 'Gagal Upload Soal');
    }

    public function selesai($id)
    {
        $item = $this->model->find($id);
        $item->done();
        if ($this->model->save($item)) {
            return redirect()->route('ujian-atur')->with('message', 'Berhasil Menyelesaikan Ujian');
        }
        return redirect()->route('ujian-atur')->with('error', 'Gagal Menyelesaikan Ujian');
    }
}