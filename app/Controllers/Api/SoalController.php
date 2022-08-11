<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use App\Entities\Ujian;
use App\Entities\Jawaban;
use CodeIgniter\API\ResponseTrait;
use stdClass;

class SoalController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->model        = model('App\Models\UjianModel');
        $this->kuliah       = model('App\Models\KuliahModel');
        $this->jawaban      = model('App\Models\JawabanModel');
        $this->session      = session();
        $this->myview       = \Config\Services::parser();
    }

    public function getSoalUjian($token, $tipe, $nomor)
    {
        $item = $this->model->where('token_ujian', $token)->first();
        $soal = $tipe == 'pilgan' ? $this->getSoalNum($item->soal_pilgan, $nomor) : $this->getSoalNum($item->soal_essay, $nomor);
        $jawab = $tipe == 'pilgan' ? $this->session->get('soal_jawab') : $this->session->get('soal_jawab_essay');
        $this->data = [
            'link_jawab' => route_to('ujian-jawab', $token, $tipe, $nomor),
            'id_ujian' => $item->id,
            'nomor' => $nomor,
            'img' => $soal->img ? base_url("soal/$token/$tipe/$nomor") . "/$soal->img" : '',
            'soal' => $soal->soal,
            'jawaban' => $jawab[$nomor]['jawaban'] ?? '',
        ];
        if ($tipe == 'pilgan') {
            shuffle($soal->pilihan);
            $abc = "A";
            foreach ($soal->pilihan as $key => $value) {
                $isSelected = $value->id === $this->data['jawaban'] ? 'checked' : '';
                $this->data['pilihan'][] = [
                    'abc' => $abc++,
                    'id' => $value->id,
                    'text' => $value->text,
                    'check' => $isSelected,
                ];
            }
        }
        $last = $tipe == 'pilgan' && empty($item->soal_essay) && sizeof($item->soal_pilgan) == $nomor ? true : ($tipe == 'essay'  && sizeof($item->soal_essay) == $nomor ? true : false);
        $result = [
            'last' => $last,
            'tipe' => $tipe,
            'nomor' => $nomor,
            'html' => $tipe == 'pilgan' ? $this->myview->setData($this->data)->render('Panel/Utils/soal_pilgan') : $this->myview->setData($this->data)->render('Panel/Utils/soal_essay'),
        ];
        $this->session->set('soal_tipe', $tipe);
        $this->session->set('soal_nomor', $nomor);
        return $this->respond($result, 200);
    }

    public function getSoalUjianNow($token, $nav)
    {
        $item = $this->model->where('token_ujian', $token)->first();
        $tipe = $this->session->get('soal_tipe');
        $nomor = $this->session->get('soal_nomor');
        if ($tipe == 'pilgan') {
            if ($nav == 'prev') {
                $nomor = $nomor == 1 ? $nomor : $nomor - 1;
            } elseif ($nav == 'next') {
                if ($nomor == sizeof($item->soal_pilgan) && sizeof($item->soal_essay) > 0) {
                    $nomor = 1;
                    $tipe = 'essay';
                } else {
                    $nomor = $nomor == sizeof($item->soal_pilgan) ? $nomor : $nomor + 1;
                }
            }
        } elseif ($tipe == 'essay') {
            if ($nav == 'prev') {
                if ($nomor == 1 && sizeof($item->soal_pilgan) > 0) {
                    $nomor = sizeof($item->soal_pilgan);
                    $tipe = 'pilgan';
                } else {
                    $nomor = $nomor == 1 ? $nomor : $nomor - 1;
                }
            } elseif ($nav == 'next') {
                $nomor = $nomor == sizeof($item->soal_essay) ? $nomor : $nomor + 1;
            }
        }
        $soal = $tipe == 'pilgan' ? $this->getSoalNum($item->soal_pilgan, $nomor) : $this->getSoalNum($item->soal_essay, $nomor);
        $jawab = $tipe == 'pilgan' ? $this->session->get('soal_jawab') : $this->session->get('soal_jawab_essay');
        $this->data = [
            'link_jawab' => route_to('ujian-jawab', $token, $tipe, $nomor),
            'id_ujian' => $item->id,
            'nomor' => $nomor,
            'img' => $soal->img ? base_url("soal/$token/$tipe/$nomor") . "/$soal->img" : '',
            'soal' => $soal->soal,
            'jawaban' => $jawab[$nomor]['jawaban'] ?? '',
        ];
        if ($tipe == 'pilgan') {
            shuffle($soal->pilihan);
            $abc = "A";
            foreach ($soal->pilihan as $key => $value) {
                $isSelected = $value->id === $this->data['jawaban'] ? 'checked' : '';
                $this->data['pilihan'][] = [
                    'abc' => $abc++,
                    'id' => $value->id,
                    'text' => $value->text,
                    'check' => $isSelected,
                ];
            }
        }
        $last = $tipe == 'pilgan' && empty($item->soal_essay) && sizeof($item->soal_pilgan) == $nomor ? true : ($tipe == 'essay'  && sizeof($item->soal_essay) == $nomor ? true : false);
        $result = [
            'nomor' => $nomor,
            'last' => $last,
            'tipe' => $tipe,
            'html' => $tipe == 'pilgan' ? $this->myview->setData($this->data)->render('Panel/Utils/soal_pilgan') : $this->myview->setData($this->data)->render('Panel/Utils/soal_essay'),
        ];
        $this->session->set('soal_tipe', $tipe);
        $this->session->set('soal_nomor', $nomor);
        return $this->respond($result, 200);
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

    public function soalEssayGambar($ujian_id, $no)
    {
        $item = $this->model->find($ujian_id);
        $soal = $this->getSoalNum($item->soal_essay, $no);
        $this->data = [
            'link_upload' => route_to('soal-essay-img-upload', $item->id, $soal->nomor),
            'link_save' => route_to('soal-essay-img-save', $item->id, $soal->nomor),
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

    public function gambarEssayUpload($ujian_id, $no)
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
                if (file_exists(FCPATH . "soal/$item->token_ujian/essay/$no/$old")) {
                    unlink(FCPATH . "soal/$item->token_ujian/essay/$no/$old");
                }
            }
            $new = "$time.{$file->getClientExtension()}";
            $this->session->set('gambar_nama', "$new");
            $file->move(FCPATH . "soal/$item->token_ujian/essay/$no", "$new");
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

    public function gambarEssaySave($ujian_id, $no)
    {
        $post = $this->request->getPost();
        $namafile = $this->session->get('gambar_nama');
        $item = $this->model->find($ujian_id);
        $key = $this->getSoalNumeric($item->soal_essay, $no);
        $soalall = $item->soal_essay;
        $soal = $item->soal_essay[$key];
        if (!$namafile) {
            return redirect()->back()->with('error', 'Anda Belum mengupload gambar');
        }
        $soal->img = $namafile;
        $soalall[$key] = $soal;
        $item->soal_essay = $soalall;
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

    public function gambarEssayDelete($ujian_id, $no)
    {
        $item = $this->model->find($ujian_id);
        $key = $this->getSoalNumeric($item->soal_essay, $no);
        $soalall = $item->soal_essay;
        $soal = $item->soal_essay[$key];
        $namafile = $soal->img;
        $soal->img = '';
        $soalall[$key] = $soal;
        $item->soal_essay = $soalall;
        if (!$this->model->save($item)) {
            return redirect()->back()->with('error', 'Anda Gagal Menghapus gambar');
        }
        if (file_exists(FCPATH . "soal/$item->token_ujian/essay/$no/$namafile")) {
            unlink(FCPATH . "soal/$item->token_ujian/essay/$no/$namafile");
        }
        return redirect()->back()->with('message', 'Gambar Berhasil Dihapus');
    }

    public function jawab($token, $tipe, $nomor)
    {
        $post = $this->request->getPost();
        $item = $this->model->where('token_ujian', $token)->first();
        $soal = $tipe == 'pilgan' ? $this->getSoalNum($item->soal_pilgan, $nomor) : $this->getSoalNum($item->soal_essay, $nomor);
        $jawaban = $post['tipe'] == 'pilgan' ? $this->session->get('soal_jawab') : $this->session->get('soal_jawab_essay');
        $jawaban[$nomor] = [
            'nomor' => $nomor,
            'jawaban' => trim($post['jawaban']),
        ];
        $post['tipe'] == 'pilgan' ? $this->session->set('soal_jawab', $jawaban) : $this->session->set('soal_jawab_essay', $jawaban);
        return $this->respond($jawaban, 200);
    }

    public function done($token)
    {
        $soal = new stdClass();
        $user = new stdClass();
        $item = new stdClass();
        // 
        $soal->nomor = $this->session->get('soal_nomor') ?? '';
        $soal->jawabPilgan = $this->session->get('soal_jawab') ?? '';
        $soal->jawabEssay = $this->session->get('soal_jawab_essay') ?? '';
        // 
        if ($soal->nomor < 1) {
            return redirect()->to('/')->with('error', 'Anda tidak sedang mengerjakan ujian');
        }
        // 
        $user->akun = user();
        $user->detail = $user->akun->getDetail();
        // 
        $item->ujian = $this->model->where('token_ujian', $token)->first();
        $item->ujianJumlahPilgan = $item->ujian->soal_pilgan ? sizeof($item->ujian->soal_pilgan) : 0;
        $item->ujianJumlahEssay = $item->ujian->soal_essay ? sizeof($item->ujian->soal_essay) : 0;
        //  
        if ($item->ujianJumlahPilgan < 1 && $item->ujianJumlahEssay < 1) {
            return redirect()->to('/')->with('error', 'Ada Kesalahan');
        }
        if ($item->ujianJumlahEssay == 0) {
            $benar = 0;
            foreach ($soal->jawabPilgan as $key => $value) {
                $ada = array_search($value['nomor'], array_column($item->ujian->soal_pilgan, 'nomor'));
                $cek = array_search($value['jawaban'], array_column($item->ujian->soal_pilgan[$ada]->pilihan, 'id'));
                $valid = $item->ujian->soal_pilgan[$ada]->pilihan[$cek];
                $benar = $valid->valid == true ? $benar + 1 : $benar + 0;
            }
            $nilai = 100 / $item->ujianJumlahPilgan * $benar;
            $kuliah = $this->kuliah->where(['mahasiswa_id' => $user->detail->id, 'matakuliah_id' => $item->ujian->matkul->id])->first();
            $kuliah->{strtolower($item->ujian->tipe)} = $nilai;
            $this->kuliah->save($kuliah);
            $this->destroy();
            return redirect()->route('ujian-jadwal')->with('message', 'Anda Telah Menyelesaikan Ujian');
        }
        // 
        $itemgo = new Jawaban();
        $itemgo->mahasiswa_id = $user->detail->id;
        $itemgo->ujian_id = $item->ujian->id;
        $itemgo->jawab_pilgan = $soal->jawabPilgan;
        $itemgo->jawab_essay = $soal->jawabEssay;
        $this->jawaban->save($itemgo);
        $this->destroy();
        return redirect()->route('ujian-jadwal')->with('message', 'Anda Telah Menyelesaikan Ujian');
    }

    protected function destroy()
    {
        $this->session->remove(['soal_tipe', 'soal_nomor', 'soal_jawab', 'soal_jawab_essay']);
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

    protected function getJawaban($items, $nomor, $arr = true)
    {
        $key = array_search($nomor, array_column($items, 'nomor'));
        return $arr ? $items[$key] : $key;
    }
}