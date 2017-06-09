<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class BisAccount extends Model
{
    //时间戳自动配置
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
        $this->save($data);
        return $this->id; //TODO 知识点
    }

}