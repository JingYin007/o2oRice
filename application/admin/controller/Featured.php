<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/23
 * Time: 0:42
 */

namespace app\admin\controller;


use think\Controller;

class Featured extends Controller
{
    public function index(){

        return $this->fetch();
    }
    public function add(){

        return $this->fetch();
    }

}