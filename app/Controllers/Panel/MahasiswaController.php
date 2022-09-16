<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;
use App\Models\MahasiswaModel as model;


class MahasiswaController extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config']   = $this->config;
        $this->model = new model();
        $this->data['menuactive'] = 'master';
    }

    public function index()
    {
        $this->data['title'] = 'Data Mahasiswa';
        $this->data['items'] = $this->model->findAll();
        return view('Panel/Page/Master/Mahasiswa/Mahasiswa', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Tambah Data Mahasiswa';
        return view('Panel/Page/Master/Mahasiswa/MahasiswaAdd', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Mahasiswa';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Master/Mahasiswa/MahasiswaEdit', $this->data);     
    }
    public function import()
    {
        $this->data['title'] = 'Import Data Mahasiswa';
        return view('Panel/Page/Master/Mahasiswa/MahasiswaImport', $this->data);
    }
}
