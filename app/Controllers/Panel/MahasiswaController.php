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
        dd($this->data['items']);
        return view('Panel/Page/panel', $this->data);
    }

    public function add()
    {
        return view('Panel/Page/panel', $this->data);
    }

    public function edit($id)
    {
        return view('Panel/Page/panel', $this->data);
    }
}
