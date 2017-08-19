<?php
namespace app\index\controller;
use think\Controller;

class Pay extends Base
{
    public function index()
    {
        if (!$this->getLoginUser()){
            $this->error('请先登录','user/login');
        }
        return $this->fetch();
    }
}
