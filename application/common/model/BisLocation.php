<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class BisLocation extends BaseModel
{
   public function getLocationsByBisID($bis_id){
       $res = $this->where('bis_id = '.$bis_id)
           ->order('id desc')
           ->paginate();
       return $res;
   }

}