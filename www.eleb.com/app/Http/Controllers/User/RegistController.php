<?php

namespace App\Http\Controllers\User;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Validator;

class RegistController extends Controller{
        //用户注册
    public function regist(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password'=>'required',
            'tel'=>'required'
        ],
            [
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'tel.required'=>'手机号不能为空',
            ]);
        //验证基本的信息(验证失败返回的信息)
        if ($validator->fails()) {
            return [
                     "status"=>"false",
                    "message"=> $validator->errors()
            ];
        }

        $code= Redis::get('code'.$request->tel);
        if($request->sms!=$code){
            return [
                "status" => "false",
                "message" => "请输入正确的验证码"
            ];
        }
         Member::create([
            'username' =>$request->username,
            'password' => bcrypt($request->password),
            'tel' =>$request->tel,
        ]);
        return [
            "status"=>"true",
            "message"=>'注册成功'
        ];
    }



}