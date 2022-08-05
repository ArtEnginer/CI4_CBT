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
        $user = user();
        $detail = $user->getDetail();
        $this->data['title'] = 'Manajemen Ujian';
        $this->data['items'] = $this->model->where('status <', '10')->findAll();
        foreach ($this->data['items'] as $key => $value) {
            if ($value->kuliah->matkul->dosen->id != $detail->id) {
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
        $this->data['items'] = $this->model->where('status <', '10')->findAll();
        foreach ($this->data['items'] as $key => $value) {
            if ($value->kuliah->mahasiswa->id != $detail->id) {
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
        $this->data['item'] = $this->kuliah->where(['mahasiswa_id' => $detail->id, 'id' => $this->data['ujian']->kuliah->id])->first();
        $this->data['user'] = $user;
        $this->data['detail'] = $detail;
        return view('Panel/Page/Ujian/nilai', $this->data);
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
                $this->session->set('soal_jawab', []);
                return redirect()->route('ujian-room', [$token, $this->session->get('soal_nomor') ?? 1]);
            }
            return redirect()->back()->with('error', 'Token yang anda masukkan salah');
            dd($post);
        }
        return view('Panel/Page/Ujian/masuk', $this->data);
    }

    public function roomUjian($token, $nomor)
    {
        $user = user();
        $detail = $user->getDetail();
        $jawaban = $this->session->get('soal_jawab');
        $waktu = Time::now();
        $post = $this->request->getPost();
        $this->data['token_ujian'] = $token;
        $nomor = $nomor ?? $this->session->get('soal_nomor');
        $jawaban_nomor = array_search($nomor, array_column($jawaban, 'nomor'));
        $this->data['jawaban'] = $jawaban_nomor ? $jawaban[$jawaban_nomor]['jawaban'] : 0;
        if (isset($post['id_pilgan'])) {
            if ($jawaban_nomor) {
                $jawaban[$jawaban_nomor] = [
                    'nomor' => $nomor,
                    'jawaban' => $post['id_pilgan'],
                ];
            } else {
                $jawaban[] = [
                    'nomor' => $nomor,
                    'jawaban' => $post['id_pilgan'],
                ];
            }
        }
        $this->session->set('soal_jawab', $jawaban);
        $this->data['item'] = $this->model->where('token_ujian', $token)->first();
        if (isset($post['act']) && $post['act'] == 'next') {
            $nomor++;
            $this->session->set('soal_nomor', $nomor);
            return redirect()->route('ujian-room', [$token, $nomor]);
        } elseif (isset($post['act']) && $post['act'] == 'prev') {
            $nomor--;
            $this->session->set('soal_nomor', $nomor);
            return redirect()->route('ujian-room', [$token, $nomor]);
        } elseif (isset($post['act']) && $post['act'] == 'done') {
            $benar = 0;
            $soal = $this->data['item']->soal_pilgan;
            foreach ($jawaban as $key => $value) {
                $ada = array_search($value['nomor'], array_column($soal, 'nomor'));
                $cek = array_search($value['jawaban'], array_column($soal[$ada]->pilihan, 'id'));
                $valid = $soal[$ada]->pilihan[$cek];
                $benar = $valid->valid == true ? $benar + 1 : $benar + 0;
            }
            $jumlahsoal = sizeof($soal);
            $nilai = 100 / $jumlahsoal * $benar;
            $kuliah = $this->kuliah->where(['mahasiswa_id' => $detail->id, 'matakuliah_id' => $this->data['item']->kuliah->matkul->id])->first();
            $kuliah->{strtolower($this->data['item']->tipe)} = $nilai;
            $this->kuliah->save($kuliah);
            $this->session->remove(['soal_nomor', 'soal_jawab']);
            return redirect()->route('ujian-jadwal')->with('message', 'Anda Telah Menyelesaikan Ujian');
        }
        $this->data['nomor'] = $nomor;
        if ($waktu->isAfter($this->data['item']->waktu->addMinutes($this->data['item']->tenggat))) {
            return redirect()->route('ujian-jadwal')->with('error', 'Waktu Ujian Sudah Berakhir');
        }
        // dd($token, $nomor);
        return view('Panel/Page/Ujian/room', $this->data);
    }
}