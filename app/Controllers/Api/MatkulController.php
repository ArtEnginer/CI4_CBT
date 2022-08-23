<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Matkul;


class MatkulController extends BaseController
{
    public function __construct()
    {
        $this->model        = model('App\Models\MatkulModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'sks' => 'required|numeric',
            'nama' => 'required|min_length[3]|max_length[50]',
            'semester' => 'required|numeric',
            // 'ruang_id' => 'required|numeric',
            'dosen_id' => 'required|numeric',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Matkul($data);
        if ($this->model->save($item)) {
            return redirect()->route('data-matkul')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            return redirect()->route('data-matkul')->with('message', 'Data telah berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();
        $Rules = [
            'sks' => 'required|numeric',
            'nama' => 'required|min_length[3]|max_length[50]',
            'semester' => 'required|numeric',
            // 'ruang_id' => 'required|numeric',
            'dosen_id' => 'required|numeric',
        ];
        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Matkul($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-matkul')->with('message', 'Data Baru telah berhasil diedit');
        }
    }
}
