<?php
namespace app\bis\controller;
use \think\Controller;
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/31
 * Time: 15:31
 */
class Register extends Controller
{
    public function index(){ 
        //获取一级城市的数据
        $firstCitys = model('city')->getNormalCitysByParentID();
        $firstCategorys = model('category')->getNormalCategorysByParentID();
        return $this->fetch('',['city'=>$firstCitys,'category'=>$firstCategorys]);
    }
    public function waiting(){
        return $this->fetch();
    }
}