<?php 
namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class KuliahCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('KuliahModel');
        return $model->find($value);
    }
   
}
?>