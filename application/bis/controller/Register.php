<?php
namespace app\bis\controller;
use \think\Controller;
use phpmailer\Email;
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
    public function add(){
        if (!request()->isPost()){
            $this->error('请求错误');
        }else{
            //获取表单的数据
            $data = input('post.');
            //检查错误
            $validate = validate('Bis');
            if (!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            //获取经纬度
            $lnglat = \Map::getLngLat($data['address']);
            if (empty($lnglat) || $lnglat['status'] != 0
                                || $lnglat['result']['precise'] != 1){
                $this->error('无法获取数据，或者匹配的地址不精确');
            }
            //判断提交的用户是否存在
            $accountRes = Model('BisAccount')
                ->get(['user_name' => $data['user_name']]);

            if ($accountRes){
                $this->error('该用户名已存在，请重新分配');
            }
            //商户基本信息入库
            $bisData = [
                'name' => $data['name'],
                'city_id' => $data['city_id'],
                'city_path' => empty($data['se_city_id'])?
                    $data['city_id']: $data['city_id'].','.$data['se_city_id'],
                'logo' => config('conf.IMG_SEVER').$data['logo'],
                'licence_logo' => config('conf.IMG_SEVER').$data['licence_logo'],
                'description' => empty($data['description'])?'':$data['description'],
                'bank_info' => $data['bank_info'],
                'bank_user'=> $data['bank_user'],
                'bank_name' => $data['bank_name'],
                'faren' => $data['faren'],
                'faren_tel' => $data['faren_tel'],
                'email' => $data['email'],
            ];

            $bisID = model('Bis')->add($bisData);
            $data['cat'] = '';
            if (!empty($data['se_category_id'])){
                $data['cat'] = implode('|',$data['se_category_id']);
            }
            //总店相关信息的检测
            $locationData = [
                'bis_id' => $bisID,
                'logo' => config('conf.IMG_SEVER').$data['logo'],
                'name' => $data['name'],
                'tel' => $data['tel'],
                'contact' => $data['contact'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id'].','.$data['cat'],
                'city_id' => $data['city_id'],
                'city_path' => empty($data['se_city_id'])?
                    $data['city_id']: $data['city_id'].','.$data['se_city_id'],
                'address' => $data['address'],
                'open_time' => $data['open_time'],
                'content' => empty($data['content'])?'':$data['content'],

                'is_main' => 1,//代表是总店的信息
                'xpoint' => empty($lnglat['result']['location']['lng'])?
                        '':$lnglat['result']['location']['lng'],
                'ypoint' => empty($lnglat['result']['location']['lat'])?
                    '':$lnglat['result']['location']['lat'],
            ];
            $locationID = model('BisLocation')->add($locationData);
            //自动生成密码加盐字符串
            $data['code'] = mt_rand(100,10000);
            //账户相关的信息检测
            $accountData = [
                'bis_id' => $bisID,
                'user_name' => $data['user_name'],
                'password' => md5($data['password'].$data['code']),
                'code' => $data['code'],
                'is_main' => 1,//代表总管理员
            ];
            $accountID = model('BisAccount')->add($accountData);
            if (!$accountID){
                $this->error('申请失败');
            }
            //发送邮件
            $title = 'o2o入驻申请通知';
            $url = request()->domain().url('bis/register/waiting');
            $content = "您提交的入驻申请需要等待审核，".
                "您可以通过点击链接 <a href='".$url."' target='_blank'> 查看链接 </a>查看审核状态";

            $mail = new Email();
            $mail::send($data['email'],$title,$content);
            $this->success('申请成功');
        }
    }
}