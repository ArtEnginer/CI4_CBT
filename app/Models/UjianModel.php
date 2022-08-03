<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'cbt_ujian';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = \App\Entities\Ujian::class;
    protected $allowedFields = [
        'kuliah_id',
        'ruang_id',
        'waktu',
        'tenggat',
        'tipe',
        'token_ujian',
        'token_akses',
        'soal_pilgan',
        'soal_essay',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['generateTokenUjian', 'generateTokenAkses'];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    protected function generateTokenUjian($data)
    {
        $data['token_ujian'] = bin2hex(random_bytes(16));
        return $data;
    }

    protected function generateTokenAkses($data)
    {
        $data['token_akses'] = strtoupper(bin2hex(random_bytes(4)));
        return $data;
    }
}