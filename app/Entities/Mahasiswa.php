<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\MahasiswaCast;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\UserModel;

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

    public function getUser()
    {
        $user = new UserModel();
        return $user->where('username', $this->attributes['nim'])->first();
    }
}