<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\KuliahModel;
use App\Models\MatkulModel;
use App\Models\RuangModel;
use App\Models\UjianModel as model;
use CodeIgniter\I18n\Time;

class UjianController extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->session = session();
        $this->data['config']   = $this->config;
        $this->model = new model();
        $this->kuliah = new KuliahModel();
        $this->matkul = new MatkulModel();
        $this->ruang = new RuangModel();
        $this->data['menuactive'] = 'ujian';
        $this->data['sekarang'] = Time::now();
    }

    public function index()
    {
        $this->data['title'] = 'Data Ujian';
        $this->data['items'] = $this->model->where('status <', '10')->findAll();
        return view('Panel/Page/Ujian/data', $this->data);
    }

    public function riwayat()
    {
        $this->data['title'] = 'Data Ujian';
        $this->data['items'] = $this->model->where('status >=', '10')->findAll();
        return view('Panel/Page/Ujian/riwayat', $this->data);
    }

    public function riwayatOnly()
    {
        $this->data['title'] = 'Data Ujian';
        $this->data['items'] = $this->model->where('status >=', '10')->findAll();
        return view('Panel/Page/Ujian/riwayat_only', $this->data);
    }

    public function detail($id)
    {
        $this->data['title'] = 'Detail Data Ujian';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Ujian/detail', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Buat Ujian Baru';
        $this->data['matkul'] = $this->matkul->findAll();
        $this->data['ruang'] = $this->ruang->findAll();
        return view('Panel/Page/Ujian/add', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Ujian';
        $this->data['matkul'] = $this->matkul->findAll();
        $this->data['ruang'] = $this->ruang->findAll();
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Ujian/edit', $this->data);
    }

    public function editSoal($id)
    {
        $this->data['title'] = 'Edit Soal Ujian';
        $this->data['item'] = $this->model->find($id);
        $this->session->remove(['gambar_token_ujian', 'gambar_nomor', 'gambar_nama']);
        // dd($this->data, $this->data['item']->soal_pilgan);
        return view('Panel/Page/Ujian/edit_soal', $this->data);
    }

    public function atur()
    {
        $user = user();
        $detail = $user->getDetail();
        $this->data['title'] = 'Manajemen Ujian';
        $this->data['items'] = $this->model->where('status <', '10')->findAll();
        foreach ($this->data['items'] as $key => $value) {
            if ($value->matkul->dosen->id != $detail->id) {
                unset($this->data['items'][$key]);
            }
        }
        return view('Panel/Page/Ujian/atur', $this->data);
    }

    public function upload($id)
    {
        $this->data['title'] = 'Manajemen Ujian';
        $this->data['id_ujian'] = $id;
        return view('Panel/Page/Ujian/upload', $this->data);
    }

    public function jadwal()
    {
        $user = user();
        $detail = $user->getDetail();
        $this->data['title'] = 'Jadwal Ujian';
        $this->data['modelKuliah'] = new KuliahModel();
        $this->data['items'] = $this->model->where(['status >' => 0])->findAll();
        foreach ($this->data['items'] as $key => $value) {
            if (!$this->kuliah->where(['mahasiswa_id' => $detail->id, 'matakuliah_id' => $value->matkul->id])->first()) {
                unset($this->data['items'][$key]);
            }
        }
        $this->data['waktu'] = Time::now();
        return view('Panel/Page/Ujian/jadwal', $this->data);
    }

    public function nilai($ujianid)
    {
        $user = user();
        $detail = $user->getDetail();
        $this->data['title'] = 'Nilai Ujian';
        $this->data['ujian'] = $this->model->find($ujianid);
        $this->data['item'] = $this->kuliah->where(['mahasiswa_id' => $detail->id, 'matakuliah_id' => $this->data['ujian']->matkul->id])->first();
        $this->data['user'] = $user;
        $this->data['detail'] = $detail;
        return view('Panel/Page/Ujian/nilai', $this->data);
    }

    public function masukUjian($token)
    {
        $this->data['item'] = $this->model->where('token_ujian', $token)->first();
        $tipeee = empty($this->data['item']->soal_pilgan) ? 'essay' : 'pilgan';
        $waktu = Time::now();
        if ($this->session->get('soal_nomor')) {
            return redirect()->route('ujian-room', [$token, $tipeee, $this->session->get('soal_nomor')]);
        }
        $post = $this->request->getPost();
        $this->data['token_ujian'] = $token;
        if ($waktu->isAfter($this->data['item']->waktu->addMinutes($this->data['item']->tenggat))) {
            return redirect()->route('ujian-jadwal')->with('error', 'Waktu Ujian Sudah Berakhir');
        }
        if ($post) {
            if ($post['token'] == $this->data['item']->token_akses) {
                $this->session->set('soal_tipe', $tipeee);
                $this->session->set('soal_nomor', 1);
                $this->session->set('soal_jawab', []);
                $this->session->set('soal_jawab_essay', []);
                return redirect()->route('ujian-room', [$token, $tipeee, $this->session->get('soal_nomor') ?? 1]);
            }
            return redirect()->back()->with('error', 'Token yang anda masukkan salah');
            dd($post);
        }
        return view('Panel/Page/Ujian/masuk', $this->data);
    }

    public function roomUjian($token, $tipe, $nomor)
    {
        $user = user();
        $detail = $user->getDetail();
        $waktu = Time::now();
        $post = $this->request->getPost();
        $item = $this->model->where('token_ujian', $token)->first();
        $soal = $tipe == 'pilgan' ? $item->soal_pilgan : $item->soal_essay;
        $nomor = $nomor ?? $this->session->get('soal_nomor');
        // dd($token, $nomor);
        $this->data['jawaban'] = 1;
        $this->data['item'] = $item;
        $this->data['pilgan'] = $item->soal_pilgan;
        $this->data['essay'] = $item->soal_essay;
        $this->data['nomor'] = $nomor;
        $this->data['token'] = $token;
        $this->data['tipe'] = $tipe;
        $this->data['soal'] = $this->getSoalNum($soal, $nomor);
        $this->data['jumlah_pilgan'] = sizeof($item->soal_pilgan);
        $this->data['jumlah_essay'] = sizeof($item->soal_essay);
        return view('Panel/Page/Ujian/room', $this->data);
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