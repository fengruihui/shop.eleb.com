<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersessionController extends Controller
{
    public function index(){
        $user=Auth::user();//只获取当前用户登录的信息
        return view('user.index',['user'=>$user]);
    }
    public function show(){

    }



    //商家登录
    public function create(){
        return view('user.create');
    }
    public function store(Request $request){

        $this->validate($request,[
            'name'=> 'required',
            'password'=>'required',

        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',

        ]);
        //查询用户表的名字
        $user=User::where('name',$request->name)->first();
        //状态为1可以登录
        if($user->status=1){
            if (Auth::attempt(['name'=>$request->name,'password'=>$request->password])){

                return redirect()->intended(route('user.index'))->with('sucess','登录成功');
            }else{
                return redirect(route('land'))->with('danger','检查一下您的用户名!密码!是否正确哦')->withInput();
            }
        }else{
            return redirect(route('land'))->with('danger','您的帐号还在审核当中哦')->withInput();
        }

        //验证数据库是否有该帐号密码

    }

    //退出登录
    public function destroy(){
        Auth::logout();
        return redirect(route('user.index'))->with('success','退出成功');
    }
    //修改密码
    public function change(User $user){
        return view('user.change',['user'=>$user]);
    }

    public function save(Request $request){
        //数据验证

        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ],[
            'old_password.required'=>'必须输入旧密码',
            'password.required'=>'请设置新密码',
            'password.confirmed'=>'两次密码输入不一致,请重新输入',
        ]);

        if(Hash::check($request->old_password,auth()->user()->password)){
            auth()->user()->update([
                'password' => bcrypt($request->password),
            ]);
            return redirect()->route('land')->with('success','管理员密码修改成功');
        }else{
            return redirect()->route('change.save')->with('success','旧密码错误');
        }
    }

}
