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
    public function _initialize()
    {
        $this->obj = model('Bis');
    }

    /**
     * 入驻申请表
     */
    public function apply(){
        $bisData = $this->obj->getBisByStatus();
        return $this->fetch('',
            ['bisData'=>$bisData]);
    }

}