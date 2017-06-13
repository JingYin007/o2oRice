<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class BisAccount extends BaseModel
{
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this
            ->allowField(true)
            ->save($data, ['id'=>$id]);
    }
}