<?php
namespace app\bis\controller;
use \think\Controller;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/31
 * Time: 15:31
 */
class Login extends Controller
{
    public function index(){
        return $this->fetch();
    }
}