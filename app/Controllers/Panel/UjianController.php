<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\KuliahModel;
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
        $this->ruang = new RuangModel();
        $this->data['menuactive'] = 'ujian';
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
        $this->data['kuliah'] = $this->kuliah->findAll();
        $this->data['ruang'] = $this->ruang->findAll();
        return view('Panel/Page/Ujian/add', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Ujian';
        $this->data['kuliah'] = $this->kuliah->findAll();
        $this->data['ruang'] = $this->ruang->findAll();
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Ujian/edit', $this->data);
    }

    public function atur()
    {
        $this->data['title'] = 'Manajemen Ujian';
        $this->data['items'] = $this->model->where('status <', '10')->findAll();
        foreach ($this->data['items'] as $key => $value) {
            if ($value->kuliah->matkul->dosen->id != 1) {
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
        $this->data['title'] = 'Jadwal Ujian';
        $this->data['items'] = $this->model->where('status <', '10')->findAll();
        foreach ($this->data['items'] as $key => $value) {
            if ($value->kuliah->mahasiswa->id != 1) {
                unset($this->data['items'][$key]);
            }
        }
        $this->data['waktu'] = Time::now();
        return view('Panel/Page/Ujian/jadwal', $this->data);
    }

    public function masukUjian($token)
    {
        $waktu = Time::now();
        if ($this->session->get('soal_nomor')) {
            return redirect()->route('ujian-room', [$token, $this->session->get('soal_nomor')]);
        }
        $post = $this->request->getPost();
        $this->data['token_ujian'] = $token;
        $this->data['item'] = $this->model->where('token_ujian', $token)->first();
        if ($waktu->isAfter($this->data['item']->waktu->addMinutes($this->data['item']->tenggat))) {
            return redirect()->route('ujian-jadwal')->with('error', 'Waktu Ujian Sudah Berakhir');
        }
        if ($post) {
            if ($post['token'] == $this->data['item']->token_akses) {
                $this->session->set('soal_nomor', 1);
                return redirect()->route('ujian-room', [$token, $this->session->get('soal_nomor') ?? 1]);
            }
            return redirect()->back()->with('error', 'Token yang anda masukkan salah');
            dd($post);
        }
        return view('Panel/Page/Ujian/masuk', $this->data);
    }

    public function roomUjian($token, $nomor)
    {
        $waktu = Time::now();
        $post = $this->request->getPost();
        $this->data['token_ujian'] = $token;
        $nomor = $nomor ?? $this->session->get('soal_nomor');
        if (isset($post['next'])) {
            $nomor++;
            return redirect()->route('ujian-room', [$token, $nomor]);
        } elseif (isset($post['prev'])) {
            $nomor--;
            return redirect()->route('ujian-room', [$token, $nomor]);
        }
        $this->session->set('soal_nomor', $nomor);
        $this->data['nomor'] = $nomor;
        $this->data['item'] = $this->model->where('token_ujian', $token)->first();
        if ($waktu->isAfter($this->data['item']->waktu->addMinutes($this->data['item']->tenggat))) {
            return redirect()->route('ujian-jadwal')->with('error', 'Waktu Ujian Sudah Berakhir');
        }
        // dd($token, $nomor);
        return view('Panel/Page/Ujian/room', $this->data);
    }
}