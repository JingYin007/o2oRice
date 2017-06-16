<?php
namespace app\admin\controller;
use think\Controller;
class Base extends  Controller {
    /**
     * 修改状态
     * @param $id
     * @param $status
     */
    public function status($id,$status=0)
    {
        $where = ['id' => intval($id)];
        $data = ['status' => $status];
        // 获取控制器
        $model = request()->controller();
        $tag = model($model)->save($data, $where);
        if ($tag) {
            return showMsg(1, '操作成功');
        } else {
            return showMsg(0, '操作失败');
        }
    }

        public function status1() {
        // 获取值
        $data = input('post.');
        // 利用tp5 validate 去做严格检验  id  status
        if(empty($data['id'])) {
            $this->error('id不合法');
        }
        if(!is_numeric($data['status'])) {
            $this->error('status不合法');
        }

        // 获取控制器
        $model = request()->controller();
        //echo $model;exit;
        $res = model($model)
            ->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if ($res){
            return showMsg(1,'操作成功');
        }else{
            return showMsg(0,'操作失败');
        }
    }
    // 排序功能 也放到 base
}