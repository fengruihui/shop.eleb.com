<?php


Route::get('/', function () {
    return view('welcome');
});


//商家注册

Route::get('/user/create','UserController@create')->name('user.create');
Route::post('/user/store','UserController@store')->name('user.store');
Route::get('/user/index','UserController@index')->name('user.index');

//商家登录
Route::get('land','UsersessionController@create')->name('land');
Route::post('land','UsersessionController@store')->name('land.store');
////商家帐号注销
Route::get('landout','UsersessionController@destroy')->name('landout');

//商家密码修改
Route::get('change','UsersessionController@change')->name('change');
Route::post('change','UsersessionController@save')->name('change.save');
//菜品分类
Route::resource('menucategory','MenucategoryController');
//菜品表
Route::resource('menus','MenusController');
//菜类搜索
Route::get('search','MenusController@search')->name('search');
//查看平台端的活动
Route::get('unactiv','MenusController@see')->name('unactiv');
Route::get('show/{activ}','MenusController@show')->name('show');
//查看平台端的订单
Route::get('order/index','Order\OrderController@index')->name('order.index');
Route::get('list/{order}','Order\OrderController@list')->name('list');
Route::get('wait','Order\OrderController@wait')->name('wait');
Route::get('finish{order}','Order\OrderController@finish')->name('finish');

//平台端的最近一周订单量
Route::get('order/weekend','Order\OrderController@weekend');