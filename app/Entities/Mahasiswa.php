<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\MahasiswaCast;

class Mahasiswa extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'mahasiswa_id' => 'mahasiswa',
    ];
    protected $castHandlers = [
        'mahasiswa' => MahasiswaCast::class,
    ];
    protected $datamap = [
        'mahasiswa' => 'mahasiswa_id',
    ];

}
?>