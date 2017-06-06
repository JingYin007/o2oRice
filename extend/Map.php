<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/25
 * Time: 22:50
 */
class Map
{
    /**
     * 根据地址来获取经纬度
     * @param $address
     * @return mixed
     */
    public static function getLngLat($address){
        //http://api.map.baidu.com/geocoder/v2/?
        //callback=renderOption&output=json&address=百度大厦&city=北京市&ak=您的ak
        if (!$address){
            return '';
        }
        $data = [
            'address' => $address,
            'ak' => config('map.ak'),
            'output' =>'json',
        ];
        $url = config('map.baidu_map_url') .config('map.geocoder') .'?'
            .http_build_query($data);
        //1.file_get_content($url)
        //2.curl
        $result = doCurl($url);
        return $result;
    }

    /**
     * http://api.map.baidu.com/staticimage/v2
     * 根据经纬度或者地址获取百度地图
     * @param $center
     * @return mixed
     */
    public static function staticimage($center){
        //
        if (!$center){
            return '';
        }
        $data = [
            'ak' => config('map.ak'),
            'width' => config('map.width'),
            'height' => config('map.height'),
            'center' => $center,
            'markers' => $center,
        ];
        $url = config('map.baidu_map_url') .config('map.staticimage') .'?'
            .http_build_query($data);
        $result = doCurl($url);
        return $result;
    }
}