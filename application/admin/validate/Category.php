<?php
namespace app\admin\validate;
use think\Validate;

/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 14:46
 */
class Category extends Validate
{
    protected $rule = [
        ['name','require|max:20','分类名必须传递|分类名不能超过十个字符'],
        ['parent_id','number'],
        ['id','number'],
        ['listorder','number'],
        ['status','number|in:-1,0,1','状态必须是数字|状态范围不合法'],
    ];
    /** 场景设置**/
    protected $scene = [
        'add' => ['name','parent_id','id'],  //添加
        'listorder' => ['id','listorder'], //排序

    ];
}