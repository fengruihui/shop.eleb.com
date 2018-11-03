<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//商家列表信息
Route::get('shop/list','User\ShopController@list');

//获取商家的指定信息
Route::get('shop/info','User\ShopController@info');

//用户注册
Route::post('user/regist','User\RegistController@regist');
//短信验证码
Route::get('sms/send','User\SmsController@send');
//用户登录
Route::post('login','User\MemberController@login');
//用户密码修改
Route::post('user/change','User\MemberController@change');
//忘记密码
Route::post('user/forget','User\MemberController@forget');
//用户收货地址添加
Route::post('add','User\MemberController@add');
//用户地址列表
Route::get('list','User\MemberController@list');
//用户地址修改
Route::get('edit','User\MemberController@edit');
//用户地址修改保存
Route::post('update','User\MemberController@update');
//购物车添加
Route::post('cart/add','Cart\CartController@add');
//获取购物车数据
Route::get('cart/cartlist','Cart\CartController@cartlist');
//订单添加
Route::post('shop/addorder','User\ShopController@addorder');
//订单列表
Route::get('order/show','User\ShopController@show');
//指定订单接口
Route::get('order/index','User\ShopController@index');