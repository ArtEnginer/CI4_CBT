<?php

namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class UjianCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('UjianModel');
        return $model->find($value);
    }
}