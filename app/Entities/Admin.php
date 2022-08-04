<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Entities\Cast\DosenCast;

class Admin extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [];
    protected $castHandlers = [];
    protected $datamap = [];
}