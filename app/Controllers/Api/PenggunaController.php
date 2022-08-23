<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\User;
use Myth\Auth\Password;
use stdClass;

class PenggunaController extends BaseController
{
    public function __construct()
    {
        $this->model        = model('App\Models\UserModel');
        $this->mahasiswa    = model('App\Models\MahasiswaModel');
        $this->dosen        = model('App\Models\DosenModel');
    }

    public function delete($group, $id)
    {
        $user = $this->model->find($id);
        if ($group == 'admin') {
            return redirect()->route('user');
        } elseif ($group == 'mahasiswa') {
            $item = $this->mahasiswa->find($user->detail_id);
            return redirect()->route('data-mahasiswa-delete', [$item->id]);
        } elseif ($group == 'dosen') {
            $item = $this->dosen->find($user->detail_id);
            return redirect()->route('data-dosen-delete', [$item->id]);
        }
    }

    public function editPassword($id){
        $data = $this->request->getPost();
        $Rules = [
            'password' => 'required|max_length[50]',
            'password_confirm' => 'required|matches[password]',
        ];
        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $user = $this->model->find($id);
        $user->password_hash = Password::hash($data['password']);
        if ($this->model->save($user)) {
            return redirect()->route('user')->with('message', 'Password telah berhasil diubah');
        }
    }
}