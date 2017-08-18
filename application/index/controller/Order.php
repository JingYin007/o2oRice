<?php
namespace app\index\controller;
use think\Controller;

class Order extends Base
{
    public function index(){

        return $this->fetch('',[
            'orders' => [],
            'controller' => 'pay',
        ]);
    }
    public function confirm(){
        if (!$this->getLoginUser()){
            $this->error('请登录','user/login');
        }
        $id=input('get.id',0,'intval');
        if(!$id){
            $this->error('参数不合法');
        }
        $buy_count = input('count',1,'intval');
        $deal = model('Deal')->find($id);
        if(!$deal || $deal->status !=1){
            $this->error('商品不存在');
        }

        $deal =  $deal->toArray();
        return $this->fetch('',[
            'deal' => $deal,
            'buy_count' => $buy_count,
            'controller' => 'pay',
            'title'=> $deal['name'].'订单确认',
        ]);
    }
}
