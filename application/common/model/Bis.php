<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
class Bis extends BaseModel
{
    public function add($data){
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }

    /**
     * 通过状态获取商家数据
     * @param int $status
     * @return \think\Paginator
     */
    public function getBisByStatus($status = 0){
        $order = [
            'id' => 'desc'];
        $data = [
            'status' => $status,
        ];

        $res = $this->where($data)
            ->order($order)
            ->paginate();
        return $res;
    }
}