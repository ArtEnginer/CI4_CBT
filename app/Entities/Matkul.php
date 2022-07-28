<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\MatkulCast;
use App\Entities\Cast\DosenCast;
use App\Entities\Cast\RuangCast;

class Matkul extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'matkul_id' => 'matkul',
        'ruang_id' => 'ruang',
        'dosen_id' => 'dosen',
    ];
    protected $castHandlers = [
        'matkul' => MatkulCast::class,
        'ruang' => RuangCast::class,
        'dosen' => DosenCast::class,
    ];
    protected $datamap = [
        'matkul' => 'matkul_id',
        'ruang' => 'ruang_id',
        'dosen' => 'dosen_id',
    ];
}
