<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class BaseModel extends Model
{
    //时间戳自动配置
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 0;
        //$data['create_time'] = time();
        $this->save($data);
        return $this->id;
    }
    public function updateById($data, $id) {
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
}