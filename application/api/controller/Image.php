<?php
/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/6/9
 * Time: 11:59
 */

namespace app\api\controller;
use think\Controller;
use think\Request;

class Image extends Controller
{
    /**
     * 图片上传方法
     */
    public function upload(){
        $file = Request::instance()->file('file');
        //给定一个目录
        $info = $file->move('upload');
        if ($info && $info->getPathname()){
            return showMsg(1,'Success','/'.$info->getPathname());
        }
        return showMsg(0,'Error');
    }
}