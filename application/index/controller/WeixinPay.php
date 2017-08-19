<?php
namespace app\index\controller;
use think\Controller;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\NativePay;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;

class WeixinPay extends Controller
{
    public function notify(){
        //测试
        $weixinData = file_get_contents("php://input");
        file_put_contents('/tmp/2.txt',$weixinData,FILE_APPEND);
    }
    public function wxpayQCode($id)
    {
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->setBody("test");
        $input->setAttach("test");
        $input->setOutTradeNo(WxPayConfig::MCHID.date("YmdHis"));
        $input->setTotalFee("1");
        $input->setTimeStart(date("YmdHis"));
        $input->setTimeExpire(date("YmdHis", time() + 600));
        $input->setGoodsTag("test");
        $input->setNotifyUrl("/index.php/index/weixinpay/notify");
        $input->setTradeType("NATIVE");
        $input->setProductId($id);
        $result = $notify->getPayUrl($input);
        if (empty($result['code_url'])){
            $url = '';
        }else{
            $url = $result["code_url"];
        }
        return '<img alt="扫码支付" src="/weixin/example/qrcode.php?data= "'.$url.' style="width:150px;height:150px;"/>
	';
    }
}
