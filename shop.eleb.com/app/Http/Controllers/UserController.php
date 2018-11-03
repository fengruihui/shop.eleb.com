<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //商户注册
    public function index(){
        $users=User::all();
        return view('user.index',['users'=>$users]);
    }
    public function create(){
        $shopCategorys=DB::table('shop_categories')->get();
        return view('user.register',['shopCategorys'=>$shopCategorys]);
    }
    //商户注册数据保存
    public function store(Request $request){
        //验证提交的表单数据
       /* $this->validate($request, [
            'shop_name' => 'required|min:2|max:30',
            'start_send' => 'required',
            'send_cost' => 'required',
            'notice' => 'required|between:3,50',
            'discount' => 'between:3,50',
            'name' => 'required|between:2,10|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|between:3,10|confirmed',
        ],[
            'shop_name.required'=>'商家名不能为空',
            'shop_name.min'=>'商家不能少于2个字',
            'name.unique' => '用户名已存在',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送费不能为空',
            'notice.between' => '店铺公告3-50个字符之间',
            'notice.required' => '店铺公告不能为空',
            'discount.between' => '优惠信息3-50个字符之间',
            'password.required'=>'密码不能为空'
        ]);*/
        $path=$request->file('shop_img')->store('public/user');

       DB::beginTransaction();


            $shops=DB::table('shops')->insertGetId([

                'shop_category_id'=>$request->shop_category_id,
                'shop_name'=>$request->shop_name,
                'shop_img'=>$path,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,

                'brand'=>$request->brand??0,
                'on_time'=>$request->on_time??0,
                'fengniao'=>$request->fengniao??0,
                'bao'=>$request->bao??0,
                'piao'=>$request->piao??0,
                'zhun'=>$request->zhun??0,
                'status'=>0,
            ]);



            DB::table('users')->insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'status'=>1,//是否可用
                'shop_id'=>$shops,
            ]);
            DB::commit();

            DB::rollBack();

        return redirect(route('user.index'))->with('success','注册成功');
    }
}
