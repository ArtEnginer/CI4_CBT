<?php 
namespace App\Entities\Cast;

use CodeIgniter\Entity\Cast\BaseCast;

class RuangCast extends BaseCast
{
    public static function get($value, array $params = [])
    {
        $model = model('RuangModel');
        return $model->find($value);
    }
   
}
?>