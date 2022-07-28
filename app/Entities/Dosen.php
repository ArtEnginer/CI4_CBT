<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\DosenCast;

class Dosen extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'dosen_id' => 'dosen',
    ];
    protected $castHandlers = [
        'dosen' => DosenCast::class,
    ];
    protected $datamap = [
        'dosen' => 'dosen_id',
    ];

}
