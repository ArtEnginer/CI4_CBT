<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\MatkulModel;
use App\Models\RuangModel;
use App\Models\KuliahModel;
use App\Models\UjianModel;


class Home extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->matkul = new MatkulModel();
        $this->ruang = new RuangModel();
        $this->kuliah = new KuliahModel();
        $this->ujian = new UjianModel();
        $this->data['config']   = $this->config;
        $this->data['menuactive'] = 'dashboard';
    }

    public function index()
    {
        $user = user();
        $detail = $user->getDetail();
        if (in_groups('Admin')) {
            $this->data['mahasiswa'] = $this->mahasiswa->countAllResults();
            $this->data['dosen'] = $this->dosen->countAllResults();
            $this->data['matkul'] = $this->matkul->countAllResults();
            $this->data['ruang'] = $this->ruang->countAllResults();
        } elseif (in_groups('Mahasiswa')) {
            $kuliah = $this->kuliah->where(['mahasiswa_id' => $detail->id])->findAll();
            $this->data['matkul'] = $this->kuliah->where('mahasiswa_id', $detail->id)->countAllResults();
            $this->data['ujian_belum'] = 0;
            foreach ($kuliah as $key => $value) {
                $this->data['ujian_belum'] = $this->data['ujian_belum'] + $this->ujian->where(['kuliah_id' => $value->id, 'status <' => 10])->countAllResults();
            }
            $this->data['ujian_sudah'] = 0;
            foreach ($kuliah as $key => $value) {
                $this->data['ujian_sudah'] = $this->data['ujian_sudah'] + $this->ujian->where(['kuliah_id' => $value->id, 'status >=' => 10])->countAllResults();
            }
            $this->data['kuliah'] = $kuliah;
        } elseif (in_groups('Dosen')) {
            $matkul = $this->matkul->where(['dosen_id' => $detail->id])->findAll();
            foreach ($matkul as $key => $value) {
                $this->data['kuliah'][] = $this->kuliah->where(['matakuliah_id' => $value->id])->first();
            }
            $this->data['ujian_belum'] = 0;
            foreach ($this->data['kuliah'] as $key => $value) {
                $this->data['ujian_belum'] = $this->data['ujian_belum'] + $this->ujian->where(['kuliah_id' => $value->id, 'status <' => 10])->countAllResults();
            }
            $this->data['ujian_sudah'] = 0;
            foreach ($this->data['kuliah'] as $key => $value) {
                $this->data['ujian_sudah'] = $this->data['ujian_sudah'] + $this->ujian->where(['kuliah_id' => $value->id, 'status >=' => 10])->countAllResults();
            }
            $this->data['matkul'] = $this->matkul->where('dosen_id', $detail->id)->countAllResults();
            $this->data['matakuliah'] = $matkul;
        }
        // dd($this->data);
        return view('Panel/Page/panel', $this->data);
    }
}