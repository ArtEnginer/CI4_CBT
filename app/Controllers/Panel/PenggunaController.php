<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\UserModel as model;


class PenggunaController extends BaseController
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
        $this->data['menuactive'] = 'user';
    }

    public function index()
    {
        $this->data['title'] = 'Pengguna';
        $this->data['items'] = $this->model->findAll();
        return view('Panel/Page/User/index', $this->data);
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
}