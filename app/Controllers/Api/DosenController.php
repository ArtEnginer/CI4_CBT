<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Dosen;


class DosenController extends BaseController
{
    public function __construct()
    {
        $this->model        = model('App\Models\DosenModel');
    }

    public function add()
    {
        $data = $this->request->getPost();
        // validation rules
        $Rules = [
            'nama' => 'required',
            'nip' => 'required|is_unique[cbt_dosen.nip]',
            'alamat' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Dosen($data);
        if ($this->model->save($item)) {
            return redirect()->route('data-dosen')->with('message', 'Data Baru telah berhasil ditambahkan');
        }
    }

    public function delete($id)
    {

        if ($this->model->delete($id)) {
            return redirect()->route('data-dosen')->with('message', 'Data telah berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $data = $this->request->getPost();

        // validation rules
        $Rules = [
            'nama' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
            'tahun_masuk' => 'required',
        ];

        if (!$this->validate($Rules)) {
            $error = $this->validator->getErrors();
            $error = implode("<br>", $error);
            //    redirect back with input
            return redirect()->back()->withInput()->with('error', $error);
        }
        $item = new Dosen($data);
        if ($this->model->update($id, $item)) {
            return redirect()->route('data-Dosen')->with('message', 'Data Baru telah berhasil diedit');
        }
    }
}
