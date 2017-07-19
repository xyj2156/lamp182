<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Home\IndexController@getIndex');
// 验证码
Route::get('/code/{id}.jpg','Admin\LoginController@code') -> where('id','\d+');

// 个人中心页面
Route::get('/personage/basic','Home\PersonageController@getIndex');
Route::post('/personage/basic','Home\PersonageController@getIndex');
// 个人修改基本信息
Route::post('/personage/save','Home\PersonageController@postSave');
// 个人安全设置
Route::post('/personage/secure','Home\PersonageController@postSecure');
// 个人余额页面
Route::post('/personage/money','Home\PersonageController@postMoney');
// 个人评论过的电影
Route::post('/personage/review','Home\PersonageController@postReview');
// 个人订单页面
Route::post('/personage/consume','Home\PersonageController@postConsume');
// 测试
Route::get('/personage/test','Home\PersonageController@getTest');


// 后台登录
Route::get('/admin/login','Admin\LoginController@login');
// 后台处理登录信息
Route::post('/admin/dologin','Admin\LoginController@dologin');
// 后台用户退出
Route::get('/admin/logout', 'Admin\LoginController@logout');



Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'admin.login'], function(){

    // 首页路由
    Route::resource('index', 'IndexController');
    // 前台用户管理模块
    Route::resource('user', 'MemberController');
    // 修改密码
    Route::resource('pass','PassController');
//    演员管理模块
    Route::resource('cast', 'CastController');
//    后台管理员信息修改（只能修改自己的）
    Route::resource('userset','UsersetController');
//    后台上传
    Route::any('upload','UsersetController@upload');

//    电影类型管理
    Route::resource('type', 'TypeController');
//    网站配置
    Route::controller('config', 'WebConfigController');
//    友情链接模块
    Route::resource('link','LinkController');
//    友情链接排序
    Route::get('link/order/{id}-{order}', 'LinkController@order');
//    后台电影路由
    Route::resource('film','FilmController');
//    影厅管理
    Route::resource('filmroom', 'FilmRoomController');
//    获取电影信息
    Route::get('films/{name}', 'FilmController@film');
//    后台管理员管理
    Route::resource('admins','AdminsController');
//    后台订单管理
    Route::resource('orders','OrdersController');
//    影厅硬件信息管理
    Route::resource('filmrooms','FilmRoomsController');
//    后台评论管理
    Route::resource('review','ReviewController');
});

Route::get('test', 'test@test');