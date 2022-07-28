<?php

namespace App\Models;

use CodeIgniter\Model;

class KuliahModel extends Model{
    protected $DBGroup = 'default';
    protected $table = 'cbt_kuliah';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = \App\Entities\Kuliah::class;
    protected $allowedFields = [
        'mahasiswa_id',
        'matakuliah_id',
        'tahun',
        'uas',
        'uts',        
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
