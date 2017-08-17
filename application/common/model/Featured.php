<?php
namespace app\common\model;

use think\Model;

class Featured extends BaseModel
{
    /**
     * 根据类型来获取列表数据
     * @param $type
     */
    public function getFeaturedsByType($type,$status=0) {
        $data = [
            'type' => $type,
            'status' => ['neq', -1],
        ];
        if ($status){
            $data['status'] = $status;
        }
        $order = ['id'=>'desc'];

        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }
}