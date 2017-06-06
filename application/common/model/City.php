<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class City extends Model
{
    //时间戳自动配置
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
        //$data['create_time'] = time();
        return $this->save($data);
    }
    public function getNormalCitysByParentID($parent_id = 0){
        $where = [
            'status' => ['neq',-1],
            'parent_id' => $parent_id,
        ];
        $order = ['id' => 'desc'];

        return $this
            ->where($where)
            ->order($order)
            ->select();
    }

    /**
     * 获取全部的一级城市分类
     */
    public function getFirstCitys($parent_id = 0){
        $where = [
            'status' => ['neq',-1],
            'parent_id' => $parent_id,
        ];
        $order = ['listorder' => 'desc'];
        $res = $this
            ->where($where)
            ->order($order)
            ->paginate(12);
        return $res;
    }
}