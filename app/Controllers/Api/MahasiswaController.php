<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Mahasiswa;
use App\Entities\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\API\ResponseTrait;

class MahasiswaController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model        = model('App\Models\MahasiswaModel');
        $this->user         = model('App\Models\UserModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'nama' => 'required',
            'nim' => 'required|is_unique[cbt_mahasiswa.nim]',
            'alamat' => 'required',
            'tahun_masuk' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Mahasiswa($data);
        $rules = config('Validation')->registrationRules ?? [
            'nim'   => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        if ($this->model->save($item)) {
            $this->user = $this->user->withGroup('mahasiswa');
            $user = new User();
            $user->detail_id = $this->model->getInsertID();
            $user->email = $item->email;
            $user->username = $item->nim;
            $user->password = '12345';
            $user->activate();
            if (!$this->user->save($user)) {
                return redirect()->back()->withInput()->with('errors', $this->user->errors());
            }
            return redirect()->route('data-mahasiswa')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        $user = $item->getUser();
        if ($this->model->delete($id)) {
            if ($this->user->delete($user->id)) {
                return redirect()->route('data-mahasiswa')->with('message', 'Data telah berhasil dihapus');
            }
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        // validation rules
        $Rules = [
            'nama' => 'required',
            'nim' => 'required',
            'alamat' => 'required',
            'tahun_masuk' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Mahasiswa($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-mahasiswa')->with('message', 'Data Baru telah berhasil diedit');
        }
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator('CBT')
            ->setLastModifiedBy('CBT')
            ->setTitle("CBT Mahasiswa")
            ->setSubject("CBT Mahasiswa")
            ->setDescription("Format untuk import Mahasiswa di CBT pada")
            ->setKeywords('Mahasiswa php CBT')
            ->setCategory('Template');

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'nim')
            ->setCellValue('B1', 'nama')
            ->setCellValue('C1', 'alamat')
            ->setCellValue('D1', 'tahun_masuk')
            ->setCellValue('E1', 'email');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('dataMahasiswa.xlsx') . '"');
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
            if (file_exists(WRITEPATH . 'uploads/dataMahasiswa.xlsx')) {
                unlink(WRITEPATH . 'uploads/dataMahasiswa.xlsx');
            }
            $file->move(WRITEPATH . 'uploads', 'dataMahasiswa.' . $file->getClientExtension());
            return $this->respond(['berhasil' => true], 200);
        }
        return $this->fail($file->getError(), 400);
    }

    public function saveExcel()
    {
        if (!file_exists(WRITEPATH . 'uploads/dataMahasiswa.xlsx')) {
            return redirect()->back()->with('error', 'Anda Belum mengupload file');
        }
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(WRITEPATH . 'uploads/dataMahasiswa.xlsx');
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

            $mhs = new Mahasiswa($item);
            // dd($mhs);
            $find = $this->model->where('nim', $mhs->nim)->first();
            $user = $this->user->where('username', $mhs->nim)->first();

            if ($find) {
                $this->model->update($find->id, $mhs);
                if ($user) {
                    $this->user->update($user->id, [
                        'email' => $mhs->email,
                    ]);
                } else {
                    $this->user = $this->user->withGroup('mahasiswa');
                    $user = new User();
                    $user->detail_id = $find->id;
                    $user->email = $mhs->email;
                    $user->username = $mhs->nim;
                    $user->password = '12345';
                    $user->activate();
                    $this->user->save($user);
                }
            } else {
                $this->model->insert($mhs);
                $this->user = $this->user->withGroup('mahasiswa');
                $user = new User();
                $user->detail_id = $this->model->getInsertID();
                $user->email = $mhs->email;
                $user->username = $mhs->nim;
                $user->password = '12345';
                $user->activate();
                $this->user->save($user);
            }
        }
        unlink(WRITEPATH . 'uploads/dataMahasiswa.xlsx');
        return redirect()->route('data-mahasiswa')->with('message', 'Data Mahasiswa Berhasil Di Import');
    }
}
