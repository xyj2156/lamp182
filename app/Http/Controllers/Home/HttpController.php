<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HttpController extends Controller
{
   /**
     * 模拟get请求
     */
    public static function gets($url, $headers=[])
    {
        $ch = curl_init();
        //设置要请求的地址
        curl_setopt($ch, CURLOPT_URL, $url);
        //设置请求头信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //设置
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    /**
     * 模拟post请求
     * @headers 是请求头信息  参数为索引数组 eg:  ['host: www.baidu.com','cookie: a=100;b=200']
     * @body   请求体   参数为关联数组  eg: ['name'=>'xiaohigh','age'=>18]
     */
    public static function posts($url, $headers=[], $body=[])
    {
        $ch = curl_init();
        //设置要请求的地址
        curl_setopt($ch, CURLOPT_URL, $url);
        //设置请求头信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //设置请求体
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        //设置
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}
