<?php 
namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class MatkulCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('MatkulModel');
        return $model->find($value);
    }
   
}
