<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 15:37
 */
use think\Model;
class Category extends Model
{
    //时间戳自动配置
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
        //$data['create_time'] = time();
        return $this->save($data);
    }
    public function getNomalCategorys($parent_id = 0,$tag = null){
        $where = [
            'status' => ['neq',-1],
            'parent_id' => $parent_id,
        ];
        $order = ['listorder' => 'desc'];
        $data = $this
            ->where($where)
            ->order($order)
            ->select();
        if ($tag == 'page'){
            $data = $this
                ->where($where)
                ->order($order)
                ->paginate();
        }
        return $data;
    }

    /**
     * 获取全部的生活分类
     * @param int $parent_id
     * @return \think\Paginator
     */
    public function getNormalCategorysByParentID($parent_id = 0){
        $where = [
            'status' => ['neq',-1],
            'parent_id' => $parent_id,
        ];
        $order = ['listorder' => 'desc'];
        $res = $this
            ->where($where)
            ->order($order)
            ->select();
        return $res;
    }
    public function getFirstCategorys($parentId = 0) {
        $data = [
            'parent_id' => $parentId,
            'status' => ['neq',-1],
        ];

        $order =[
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        //echo $this->getLastSql();

        return $result;

    }

    public function getNormalCategoryByParentId($parentId=0) {
        $data = [
            'status' => 1,
            'parent_id' => $parentId,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    public function getNormalRecommendCategoryByParentId($id=0, $limit=5) {
        $data = [
            'parent_id' => $id,
            'status' => 1,
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order);
        if($limit) {
            $result = $result->limit($limit);
        }

        return $result->select();

    }

    public function getNormalCategoryIdParentId($ids) {
        $data = [
            'parent_id' => ['in', implode(',', $ids)],
            'status' => 1,
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order)
            ->select();

        return $result;
    }
}