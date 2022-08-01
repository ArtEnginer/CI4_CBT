<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Ujian extends Entity
{
    protected $dates = ['tanggal', 'created_at', 'updated_at'];
    protected $casts = [];
    protected $castHandlers = [];
    protected $datamap = [];
}