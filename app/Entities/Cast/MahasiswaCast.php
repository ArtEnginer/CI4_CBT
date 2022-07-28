<?php 
namespace App\Entities\Cast;
use CodeIgniter\Entity\Cast\BaseCast;

class MahasiswaCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('MahasiswaModel');
        return $model->find($value);
    }   
   
}
