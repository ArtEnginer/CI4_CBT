<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

use App\Models\RuangModel;


class RuangController extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config']   = $this->config;
        $this->model = new RuangModel();
        $this->data['menuactive'] = 'master';
    }

    public function index()
    {
        $this->data['title'] = 'Data Ruang';
        $this->data['items'] = $this->model->findAll();
        return view('Panel/Page/Master/Ruang/Ruang', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Tambah Data Ruang';
        return view('Panel/Page/Master/Ruang/RuangAdd', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Ruang';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/Master/Ruang/RuangEdit', $this->data);
    }
}
