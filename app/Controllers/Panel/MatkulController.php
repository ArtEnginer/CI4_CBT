<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\MatkulModel;
use App\Models\DosenModel;
use App\Models\RuangModel;


class MatkulController extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config']   = $this->config;
        $this->model = new MatkulModel();
        $this->dosenModel = new DosenModel();
        $this->ruangModel = new RuangModel();
        $this->data['menuactive'] = 'master';
    }

    public function index()
    {
        $this->data['title'] = 'Data Matkul';
        $this->data['items'] = $this->model->findAll();
        // dd($this->data['items']);
        return view('Panel/Page/Master/Matkul/Matkul', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Tambah Data Matkul';
        $this->data['dosen'] = $this->dosenModel->findAll();
        $this->data['ruang'] = $this->ruangModel->findAll();
        return view('Panel/Page/Master/Matkul/MatkulAdd', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Matkul';
        $this->data['item'] = $this->model->find($id);
        $this->data['dosen'] = $this->dosenModel->findAll();
        $this->data['ruang'] = $this->ruangModel->findAll();
        return view('Panel/Page/Master/Matkul/MatkulEdit', $this->data);
    }
}
