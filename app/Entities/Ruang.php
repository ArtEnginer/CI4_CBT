<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\RuangCast;

class Ruang extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'ruang_id' => 'ruang',
    ];
    protected $castHandlers = [
        'ruang' => RuangCast::class,
    ];
    protected $datamap = [
        'ruang' => 'ruang_id',
    ];

}
