<?php
namespace app\bis\controller;
use think\Controller;
class Deal extends  Base
{
    private $obj;
    public function __construct()
    {
        parent::__construct();
        $this->obj = model('Deal');
    }

    /**
     * @return mixed 商户中心的 deal列表页面 小伙伴自行完成
     */
    public function index()
    {
        $bisId = $this->getLoginUser()->bis_id;
        $resList = $this->obj->getNormalDealsByBisID($bisId);
        return $this->fetch('',[
            'resList' => $resList,
        ]);
    }

    public function  add() {
        $bisId = $this->getLoginUser()->bis_id;
        if(request()->isPost()) {
            // 走插入逻辑
            $data = input('post.','','htmlentities');
            $location_ids = isset($data['location_ids'])?$data['location_ids']:null;
            // 严格校验提交的数据， tp5 validate 小伙伴自行完成，
            $location = isset($location_ids)?model('BisLocation')->get($location_ids):null;
            $deals = [
                'bis_id' => $bisId,
                'name' => $data['name'],
                'image' => $data['image'],
                'category_id' => $data['category_id'],
                'se_category_id' => empty($data['se_category_id']) ? '' : implode(',', $data['se_category_id']),
                'city_id' => $data['city_id'],
                'location_ids' => empty($data['location_ids']) ? '' : implode(',', $data['location_ids']),
                'start_time' => strtotime($data['start_time']),
                'end_time' => strtotime($data['end_time']),
                'total_count' => $data['total_count'],
                'origin_price' => $data['origin_price'],
                'current_price' => $data['current_price'],
                'coupons_begin_time' => strtotime($data['coupons_begin_time']),
                'coupons_end_time' => strtotime($data['coupons_end_time']),
                'notes' => isset($data['notes'])?$data['notes']:'',
                'description' => isset($data['description'])?$data['description']:'',
                'bis_account_id' => $this->getLoginUser()->id,
                'xpoint' => $location->xpoint,
                'ypoint' => $location->ypoint,

            ];

            $id = model('Deal')->add($deals);
            if($id) {
                $this->success('添加成功', url('deal/index'));
            }else {
                $this->error('添加失败');
            }

        }else {
            //获取一级城市的数据
            $citys = model('City')->getNormalCitysByParentId();
            //获取一级栏目的数据
            $categorys = model('Category')->getNormalCategorysByParentID();
            return $this->fetch('', [
                'citys' => $citys,
                'categorys' => $categorys,
                'bislocations' => model('BisLocation')->getNormalLocationByBisId($bisId),
            ]);
        }
    }

    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function status($id,$status=0){
        $where = ['id'=>intval($id)];
        $data = ['status' => $status];
        $tag =$this->obj->save($data,$where);
        if ($tag){
            return showMsg(1,'操作成功');
        }else{
            return showMsg(0,'操作失败');
        }
    }
    public function delete($id){
        $data = ['status' => -1];
        $tag =$this->obj->save($data,['id' => intval($id)]);
        if ($tag){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}
