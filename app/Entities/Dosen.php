<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\DosenCast;
use App\Models\UserModel;

class Dosen extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [];
    protected $castHandlers = [];
    protected $datamap = [];

    public function getUser()
    {
        $user = new UserModel();
        return $user->where('username', $this->attributes['nip'])->first();
    }
}