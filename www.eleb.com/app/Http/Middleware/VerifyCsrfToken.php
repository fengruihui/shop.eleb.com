<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'user/regist',//用户注册
        'login',//用户登录
        'add',//添加地址
        'update',
        'cart/add',
        'user/change',//密码修改
        'user/forget',
        'shop/addorder'
    ];
}
