<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\JawabanModel;
use App\Models\KuliahModel;
use App\Models\MatkulModel;
use App\Models\RuangModel;
use App\Models\UjianModel as model;
use App\Models\MahasiswaModel;
use CodeIgniter\I18n\Time;
use stdClass;

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
        $this->jawaban = new JawabanModel();
        $this->mahasiswa = new MahasiswaModel();
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

    public function review()
    {
        $user = user();
        $detail = $user->getDetail();
        $ujian = $this->model->where('status <', '10')->findAll();
        $datasets = [];
        foreach ($ujian as $key => $value) {
            if ($value->matkul->dosen->id != $detail->id) {
                unset($ujian[$key]);
            } else {
                $temp = $this->jawaban->where(['ujian_id' => $value->id])->findAll();
                $datasets = array_merge($datasets, $temp);
            }
        }
        $this->data['title'] = 'Review Jawaban';
        $this->data['items'] = $datasets;
        // d($ujian, $datasets, $this->data);
        return view('Panel/Page/Ujian/review', $this->data);
    }

    public function reviewJawaban($id)
    {
        $items = new stdClass;
        $items->user = user();
        $items->detail = $items->user->getDetail();
        $items->jawaban = $this->jawaban->find($id);
        $items->ujian = $this->model->find($items->jawaban->ujian->id);
        $items->mahasiswa = $this->mahasiswa->find($items->jawaban->mahasiswa->id);
        $items->multi = $items->ujian->soal_pilgan ? true : false;
        $this->data['title'] = 'Review Jawaban';
        $this->data['items'] = $items;
        // d($this->data, $items->jawaban->jawab_pilgan);
        return view('Panel/Page/Ujian/review_jawaban', $this->data);
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
            } else {
                $cekjawaban = $this->jawaban->where(['mahasiswa_id' => $detail->id, 'ujian_id' => $value->id])->first();
                $this->data['items'][$key]->done = $cekjawaban ? true : false;
            }
        }
        $this->data['waktu'] = Time::now();
        // dd($this->data);
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
        if ($this->session->get('soal_nomor') && $this->session->get('soal_tipe')) {
            return redirect()->route('ujian-room', [$token, $this->session->get('soal_tipe'), $this->session->get('soal_nomor')]);
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
        if (!$this->session->get('soal_nomor')) {
            return redirect()->to('/')->with('error', 'Anda Tidak Sedang Ujian');
        }
        $user = user();
        $detail = $user->getDetail();
        $waktu = Time::now();
        $post = $this->request->getPost();
        $item = $this->model->where('token_ujian', $token)->first();
        $dateline = $item->waktu->addMinutes($item->tenggat);
        $soal = $tipe == 'pilgan' ? $item->soal_pilgan : $item->soal_essay;
        $nomor = $nomor ?? $this->session->get('soal_nomor');
        $jawab = $tipe == 'pilgan' ? ($this->session->get('soal_jawab') ?? '') : ($this->session->get('soal_jawab_essay') ?? '');
        if ($waktu->isAfter($dateline)) {
            return redirect()->route('ujian-done', [$token])->with('error', 'Waktu Ujian Sudah Berakhir');
        }
        $this->session->set('soal_tipe', $tipe);
        $this->session->set('soal_nomor', $nomor);
        // dd($token, $nomor);
        $this->data['jawaban'] = $jawab[$nomor]['jawaban'] ?? '';
        $this->data['item'] = $item;
        $this->data['pilgan'] = $item->soal_pilgan;
        $this->data['essay'] = $item->soal_essay;
        $this->data['nomor'] = $nomor;
        $this->data['token'] = $token;
        $this->data['tipe'] = $tipe;
        $this->data['soal'] = $this->getSoalNum($soal, $nomor);
        $this->data['jumlah_pilgan'] = $item->soal_pilgan ? sizeof($item->soal_pilgan) : 0;
        $this->data['jumlah_essay'] = $item->soal_essay ? sizeof($item->soal_essay) : 0;
        $this->data['dateline'] = $dateline->toDateTimeString();
        if (($tipe == 'pilgan' && $this->data['jumlah_pilgan'] == 0) || ($tipe == 'essay' && $this->data['jumlah_essay'] == 0)) {
            return $tipe == 'pilgan' ? redirect()->route('ujian-room', [$token, 'pilgan', 1]) : redirect()->route('ujian-room', [$token, 'essay', 1]);
        } elseif (($tipe == 'pilgan' && $this->data['jumlah_essay'] == 0 && $nomor > $this->data['jumlah_pilgan']) || ($tipe == 'essay' && $nomor > $this->data['jumlah_essay'])) {
            return redirect()->route('ujian-room', [$token, $tipe, 1]);
        }
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