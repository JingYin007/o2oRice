<?php
namespace app\common\validate;
use think\Validate;

/**
 * Created by PhpStorm.
 * User: 百鬼夜行
 * Date: 2017/5/23
 * Time: 14:46
 */
class Bis extends Validate
{
    protected $rule = [
        'name' => 'require|max:30',
        'email' => 'email',
        'logo' => 'require',
        'city_id' => 'require',
        'bank_info' => 'require',
        'bank_name' => 'require',
        'bank_user' => 'require',
        'faren' => 'require',
        'faren_tel' => 'require',
    ];
    /** 场景设置**/
    protected $scene = [
        'add' => ['name','email','logo','city_id',
                'bank_info','bank_name','bank_user','faren','faren_tel'],  //添加

    ];
}