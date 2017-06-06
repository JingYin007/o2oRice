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

class Map extends Controller
{
    public function index(){
        $address = '北京房山长阳地铁站';
        $res = \Map::getLngLat($address);
        var_dump($res);
    }
    public function map(){
        //http://api.map.baidu.com/geocoder/v2/?callback=renderOption&output=json&address=百度大厦&city=北京市&ak=您的ak
        $center = '西城区大观园';
        $map = \Map::staticimage($center);
        return $map;
    }
    public function send(){
        $to = '930959695@qq.com';
        $from = '15117972683@163.com';
        $content = '这都是什么鬼啊啊啊啊！';
        $mail = new Email();
        $mail::send($to,$from,$content);
    }
}