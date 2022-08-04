<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Mahasiswa;
use App\Entities\User;

class MahasiswaController extends BaseController
{
    public function __construct()
    {
        $this->model        = model('App\Models\MahasiswaModel');
        $this->user         = model('App\Models\UserModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'nama' => 'required',
            'nim' => 'required|is_unique[cbt_mahasiswa.nim]',
            'alamat' => 'required',
            'tahun_masuk' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Mahasiswa($data);
        $rules = config('Validation')->registrationRules ?? [
            'nim'   => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        if ($this->model->save($item)) {
            $this->user = $this->user->withGroup('mahasiswa');
            $user = new User();
            $user->detail_id = $this->model->getInsertID();
            $user->email = $item->email;
            $user->username = $item->nim;
            $user->password = '12345';
            $user->activate();
            if (!$this->user->save($user)) {
                return redirect()->back()->withInput()->with('errors', $this->user->errors());
            }
            return redirect()->route('data-mahasiswa')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        $user = $item->getUser();
        if ($this->model->delete($id)) {
            if ($this->user->delete($user->id)) {
                return redirect()->route('data-mahasiswa')->with('message', 'Data telah berhasil dihapus');
            }
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        // validation rules
        $Rules = [
            'nama' => 'required',
            'nim' => 'required',
            'alamat' => 'required',
            'tahun_masuk' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Mahasiswa($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-mahasiswa')->with('message', 'Data Baru telah berhasil diedit');
        }
    }
}