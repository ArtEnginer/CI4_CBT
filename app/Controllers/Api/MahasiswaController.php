<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Mahasiswa;


class MahasiswaController extends BaseController
{
    public function __construct()
    {
        $this->model        = model('App\Models\MahasiswaModel');
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
        if ($this->model->save($item)) {
            return redirect()->route('data-mahasiswa')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {

        if ($this->model->delete($id)) {
            return redirect()->route('data-mahasiswa')->with('message', 'Data telah berhasil dihapus');
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
