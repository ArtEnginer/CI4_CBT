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
        'tanggal',
        'tenggat',
        'tipe',
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
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
