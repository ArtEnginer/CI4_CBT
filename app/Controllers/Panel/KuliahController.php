<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;
use App\Models\KuliahModel as model;
use App\Models\MahasiswaModel as MahasiswaModel;
use App\Models\MatkulModel as MatkulModel;

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
        $this->MahasiswaModel = new MahasiswaModel();
        $this->MatkulModel = new MatkulModel();
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
        $this->data['mahasiswa'] = $this->MahasiswaModel->findAll();
        $this->data['matkul'] = $this->MatkulModel->findAll();
        return view('Panel/Page/Master/Kuliah/KuliahAdd', $this->data);
        
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Dosen';
        $this->data['item'] = $this->model->find($id);
        $this->data['mahasiswa'] = $this->MahasiswaModel->findAll();
        $this->data['matkul'] = $this->MatkulModel->findAll();
        return view('Panel/Page/Master/Kuliah/KuliahEdit', $this->data);
        
    }


}
