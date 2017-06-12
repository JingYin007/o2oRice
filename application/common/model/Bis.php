<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class Bis extends BaseModel
{
    public function add($data){
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
}