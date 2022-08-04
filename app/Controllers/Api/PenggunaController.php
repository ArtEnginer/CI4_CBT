<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\User;
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
}