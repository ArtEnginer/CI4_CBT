<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;
use App\Models\KuliahModel as model;


class KuliahController extends BaseController
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
        $this->data['title'] = 'Data Kuliah';
        $this->data['items'] = $this->model->findAll();
        return view('Panel/Page/Master/Kuliah/Kuliah', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Tambah Data Kuliah';
        return view('Panel/Page/Master/Kuliah/KuliahAdd', $this->data);
        
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Dosen';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Master/Kuliah/KuliahEdit', $this->data);
        
    }


}
