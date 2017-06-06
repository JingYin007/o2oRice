<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/23
 * Time: 0:42
 */

namespace app\admin\controller;


use think\Controller;

class Order extends Controller
{
    public function index(){
        $arr = array();
        $this->assign('orders',$arr);

        return $this->fetch();
    }

    public function detail(){

        return $this->fetch();
    }
}