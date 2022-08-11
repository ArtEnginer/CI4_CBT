<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\MahasiswaCast;
use App\Entities\Cast\ujianCast;

class Jawaban extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'ujian_id' => 'ujian',
        'mahasiswa_id' => 'mahasiswa',
        'jawab_pilgan' => 'json',
        'jawab_essay' => 'json',
    ];
    protected $castHandlers = [
        'mahasiswa' => MahasiswaCast::class,
        'ujian' => UjianCast::class,
    ];
    protected $datamap = [
        'mahasiswa' => 'mahasiswa_id',
        'ujian' => 'ujian_id',
    ];
}