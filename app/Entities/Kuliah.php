<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\MatkulCast;
use App\Entities\Cast\MahasiswaCast;
use App\Entities\Cast\KuliahCast;

class Kuliah extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'kuliah_id' => 'kuliah',
        'matakuliah_id' => 'matkul',
        'mahasiswa_id' => 'mahasiswa',

    ];
    protected $castHandlers = [
        'kuliah' => KuliahCast::class,
        'matkul' => MatkulCast::class,
        'mahasiswa' => MahasiswaCast::class,

    ];
    protected $datamap = [
        'kuliah_id' => 'kuliah_id',
        'matkul' => 'matakuliah_id',
        'mahasiswa' => 'mahasiswa_id',
    ];

    
}
