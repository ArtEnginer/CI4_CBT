<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;
use App\Models\DosenModel as model;


class DosenController extends BaseController
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
        $this->data['title'] = 'Data Dosen';
        $this->data['items'] = $this->model->findAll();
        return view('Panel/Page/Master/Dosen/Dosen', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Tambah Data Dosen';
        return view('Panel/Page/Master/Dosen/DosenAdd', $this->data);
        
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Dosen';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Master/Dosen/DosenEdit', $this->data);
        
    }


}
