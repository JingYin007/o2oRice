<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status){
    $str = "";
    if ($status == 1){
        $str .= "<span class='label label-success radius'>".'正常';
    }elseif ($status == 0){
        $str .= "<span class='label label-danger radius'>".'待审';
    }else{
        $str .= "<span class='label radius'>".'删除';
    }
    $str .= "</span>";
    return $str;
}

/**
 * 公用的方法  进行信息的提示
 * @param $status
 * @param $message
 * @param array $data
 */
function showMsg($status,$message,$data=array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}

function doCurl($url,$type = 0,$data=[]){
    $ch = curl_init();//初始化
    //设置选项
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);

    if($type == 1){
        //post
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }
    //执行并获取内容
    $output = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    return $output;
}
//商户入驻申请的文案
function bisRegister($status){
    if($status == 1){
        $str = '入驻申请成功,请随时关注';
    }elseif ($status == 0){
        $str = '待审核，审核后平台方会发送邮件通知，请关注...';
    }elseif ($status == 2){
        $str = '非常抱歉，您提交的材料不符合条件，请重新提交';
    }else{
        $str = '该申请已被删除';
    }
    return $str;
}