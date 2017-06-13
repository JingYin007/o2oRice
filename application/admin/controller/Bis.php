<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/25
 * Time: 22:41
 */

namespace app\admin\controller;
use phpmailer\Email;
use think\Controller;

class Bis extends Controller
{
    private $obj;
    private $obj_location;
    private $obj_account;
    public function _initialize()
    {
        $this->obj = model('Bis');
        $this->obj_location = model('BisLocation');
        $this->obj_account = model('BisAccount');
    }
    public function index(){
        $bisData = $this->obj->getBisByStatus(1);
        return $this->fetch('',
            ['bisData'=>$bisData]);
    }
    /**
     * 入驻申请表
     */
    public function apply(){
        $bisData = $this->obj->getBisByStatus();
        return $this->fetch('',
            ['bisData'=>$bisData]);
    }

    public function detail(){
        $id = input('get.id',0,'intval');
        //获取一级城市的数据
        $firstCitys = model('city')->getNormalCitysByParentID();
        $firstCategorys = model('category')->getNormalCategorysByParentID();
        //获取商户数据
        $bis = $this->obj->get($id);
        $bis_location = $this->obj_location->get(['bis_id'=>$id,'is_main'=>1]);
        $bis_account = $this->obj_account->get(['bis_id = '.$id,'is_main'=>1]);

        return $this->fetch('',[
            'city' => $firstCitys,
            'category' => $firstCategorys,
            'bis' => $bis,
            'location' => $bis_location,
            'account' => $bis_account,

        ]);

    }
    // 修改状态
    public function status() {
        $data = input('post.');
        // 检验小伙伴自行完成
        /*$validate = validate('Bis');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }*/

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        $location = model('BisLocation')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        $account = model('BisAccount')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        if($res && $location && $account) {
            // 发送邮件
            // status 1  status 2  status -1
            // \phpmailer\Email::send($data['email'],$title, $content);
            return showMsg(1,'状态更新成功');
        }else {
            return showMsg(0,'状态更新失败');
        }

    }
}