<?php
namespace app\index\controller;
use think\Controller;

class Index extends Base
{
    public function index()
    {
        //return [1,2];
        // 获取首页大图 相关数据
        $homeBigAD = model('Featured')->getFeaturedsByType(0,1);
        // 获取右侧广告位相关的数据
        $rightAD = model('Featured')->getFeaturedsByType(1,1);
        // 商品分类 数据-美食 推荐的数据
        $datas = model('Deal')->getNormalDealByCategoryCityId(8, $this->city->id);
        // 获取4个子分类
        $meishicates = model('Category')->getNormalRecommendCategoryByParentId(5, 4);

        return $this->fetch('',[
            'homeBigAD' => $homeBigAD,
            'rightAD' => $rightAD,
            'datas' => $datas,
            'meishicates' => $meishicates,
            'controller' => 'ms',
        ]);
    }
}
