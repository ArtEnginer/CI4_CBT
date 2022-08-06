<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Kuliah;


class KuliahController extends BaseController
{
    public function __construct()
    {
        $this->model        = model('App\Models\KuliahModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'mahasiswa_id' => 'required',
            'matakuliah_id' => 'required',
            'tahun' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Kuliah($data);
        if ($this->model->save($item)) {
            return redirect()->route('data-kuliah')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {

        if ($this->model->delete($id)) {
            return redirect()->route('data-kuliah')->with('message', 'Data telah berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        // validation rules
        $Rules = [
            'mahasiswa_id' => 'required',
            'matakuliah_id' => 'required',
            'tahun' => 'required',
            'uas' => 'required',
            'uts' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Kuliah($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-kuliah')->with('message', 'Data Baru telah berhasil diedit');
        }
    }
}