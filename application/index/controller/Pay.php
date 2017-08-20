<?php
namespace app\index\controller;
use think\Controller;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\NativePay;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
class Pay extends Base
{
    public function index()
    {
        if (!$this->getLoginUser()){
            $this->error('请先登录','user/login');
        }
        $product_id = time();
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->setBody("商品名称");
        $input->setAttach("商品名称");
        $input->setOutTradeNo(WxPayConfig::MCHID.date("YmdHis"));
        $input->setTotalFee("1");
        $input->setTimeStart(date("YmdHis"));
        $input->setTimeExpire(date("YmdHis", time() + 600));
        $input->setGoodsTag("QRCode");
        $input->setNotifyUrl("/index.php/index/weixinpay/notify");
        $input->setTradeType("NATIVE");
        //$product_id 为商品自定义id 可用作订单ID
        $input->setProductId($product_id);
        $result = $notify->getPayUrl($input);
        if (empty($result['code_url'])){
            $url = '';
        }else{
            $url = $result["code_url"];
        }



        return $this->fetch('',[
            'qrCode_url' => $url,
        ]);
    }
}
