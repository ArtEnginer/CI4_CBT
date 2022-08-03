<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\KuliahCast;
use App\Entities\Cast\RuangCast;
use App\Entities\Cast\CastUjianStatus;

class Ujian extends Entity
{
    protected $dates = ['waktu', 'created_at', 'updated_at'];
    protected $casts = [
        'kuliah_id' => 'kuliah',
        'ruang_id' => 'ruang',
        'status' => 'status',
        'soal_pilgan' => 'json',
        'soal_essay' => 'json',
    ];
    protected $castHandlers = [
        'kuliah' => KuliahCast::class,
        'ruang' => RuangCast::class,
        'status' => CastUjianStatus::class,
    ];
    protected $datamap = [
        'kuliah' => 'kuliah_id',
        'ruang' => 'ruang_id',
    ];

    public function setToken()
    {
        $this->attributes['token_ujian'] = $this->attributes['token_ujian'] ?? bin2hex(random_bytes(16));
        $this->attributes['token_akses'] = strtoupper(bin2hex(random_bytes(4)));
    }
}