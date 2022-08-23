<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\UserModel as model;
use stdClass;

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

    public function edit($id)
    {
        $item = $this->model->find($id);
        $item->role = new stdClass;
        $item->detail = $item->getDetail();
        $item->roles = $item->getRoles();
        foreach ($item->roles as $id => $role) {
            $item->role->id = $id;
            $item->role->name = $role;
        }
        unset($item->roles);
        $this->data['item'] = $item;
        if ($item->role->id == 1) {
            return redirect()->route('user');
        } elseif ($item->role->id == 2) {
            return redirect()->route('data-mahasiswa-edit', [$item->detail_id]);
        } elseif ($item->role->id == 3) {
            return redirect()->route('data-dosen-edit', [$item->detail_id]);
        }
    }

    public function detail($id)
    {
        $this->data['title'] = 'Detail Data Pengguna';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/User/detail', $this->data);
    }

    public function editPassword($id)
    {
        $this->data['title'] = 'Edit Password';
        $this->data['item'] = $this->model->find($id);
        return view('Panel/Page/User/editPassword', $this->data);
    }
}