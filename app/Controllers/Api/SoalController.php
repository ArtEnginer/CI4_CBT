<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use App\Entities\Ujian;
use CodeIgniter\API\ResponseTrait;


class SoalController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model        = model('App\Models\UjianModel');
        $this->session      = session();
        $this->myview       = \Config\Services::parser();
    }

    public function soalPilganGambar($ujian_id, $no)
    {
        $item = $this->model->find($ujian_id);
        $soal = $this->getSoalNum($item->soal_pilgan, $no);
        $this->data = [
            'link_upload' => route_to('soal-pilgan-img-upload', $item->id, $soal->nomor),
            'link_save' => route_to('soal-pilgan-img-save', $item->id, $soal->nomor),
            'id_ujian' => $item->id,
            'nomor' => $soal->nomor,
        ];
        return $this->myview->setData($this->data)->render('Panel/Utils/img_upload');
    }

    public function gambarPilganUpload($ujian_id, $no)
    {
        $item = $this->model->find($ujian_id);
        $time = time();
        $this->session->set('gambar_token_ujian', $item->token_ujian);
        $this->session->set('gambar_nomor', $no);
        if (!$this->validate([
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/JPG,,image/jpeg]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa Gambar',
                ]

            ]
        ])) {
            return $this->fail($this->validator->getErrors(), 400);
        }
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $old = $this->session->get('gambar_nama');
            if ($old) {
                if (file_exists(FCPATH . "soal/$item->token_ujian/pilgan/$no/$old")) {
                    unlink(FCPATH . "soal/$item->token_ujian/pilgan/$no/$old");
                }
            }
            $new = "$time.{$file->getClientExtension()}";
            $this->session->set('gambar_nama', "$new");
            $file->move(FCPATH . "soal/$item->token_ujian/pilgan/$no", "$new");
            return $this->respond(['berhasil' => true], 200);
        }
        return $this->fail($file->getError(), 400);
    }

    public function gambarPilganSave($ujian_id, $no)
    {
        $post = $this->request->getPost();
        $namafile = $this->session->get('gambar_nama');
        $item = $this->model->find($ujian_id);
        $key = $this->getSoalNumeric($item->soal_pilgan, $no);
        $soalall = $item->soal_pilgan;
        $soal = $item->soal_pilgan[$key];
        if (!$namafile) {
            return redirect()->back()->with('error', 'Anda Belum mengupload gambar');
        }
        $soal->img = $namafile;
        $soalall[$key] = $soal;
        $item->soal_pilgan = $soalall;
        if (!$this->model->save($item)) {
            return redirect()->back()->with('error', 'Anda Gagal mengupload gambar');
        }
        $this->session->remove(['gambar_token_ujian', 'gambar_nomor', 'gambar_nama']);
        return redirect()->back()->with('message', 'Gambar Berhasil Diupload');
    }

    public function gambarPilganDelete($ujian_id, $no)
    {
        $item = $this->model->find($ujian_id);
        $key = $this->getSoalNumeric($item->soal_pilgan, $no);
        $soalall = $item->soal_pilgan;
        $soal = $item->soal_pilgan[$key];
        $namafile = $soal->img;
        $soal->img = '';
        $soalall[$key] = $soal;
        $item->soal_pilgan = $soalall;
        if (!$this->model->save($item)) {
            return redirect()->back()->with('error', 'Anda Gagal Menghapus gambar');
        }
        if (file_exists(FCPATH . "soal/$item->token_ujian/pilgan/$no/$namafile")) {
            unlink(FCPATH . "soal/$item->token_ujian/pilgan/$no/$namafile");
        }
        return redirect()->back()->with('message', 'Gambar Berhasil Dihapus');
    }

    protected function getSoalNum($items, $nomor)
    {
        $array = $items;

        foreach ($array as $element) {
            if ($nomor == $element->nomor) {
                return $element;
            }
        }
        return false;
    }

    protected function getSoalNumeric($items, $nomor)
    {
        $array = $items;

        foreach ($array as $key => $element) {
            if ($nomor == $element->nomor) {
                return $key;
            }
        }
        return false;
    }
}