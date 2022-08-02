<?php

namespace App\Entities\Cast;

use App\Libraries\UjianStatus;
use CodeIgniter\Entity\Cast\BaseCast;

class CastUjianStatus extends BaseCast
{
    public static function get($value, array $params = [])
    {
        return new UjianStatus($value);
    }
}