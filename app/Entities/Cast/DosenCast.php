<?php 
namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class DosenCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('DosenModel');
        return $model->find($value);
    }
   
}
?>