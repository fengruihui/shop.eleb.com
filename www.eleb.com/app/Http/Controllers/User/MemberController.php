<?php

namespace App\Http\Controllers\User;


use App\Models\Addresse;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Validator;
class MemberController extends Controller{
    //用户登录
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password'=>'required',
        ],
            [
                'name.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            ]);
        //验证登录失败
        if($validator->fails()){
            return [
                'status'=>"false",
                "message"=> $validator->errors()
            ];
        }
        //登录验证
        if(Auth::attempt(['username'=>$request->name,'password'=>$request->password])){

            return [
                'username'=>$request->name,
                'user_id'=>Auth::user()->id,
                'status'=>"true",
               "message"=>"登录成功",
            ];
        }else{
            //登录失败
            return [
                'status'=>"false",
                "message"=> '用户名或者密码错误请重新输入'
                ];
        }

    }
    //用户密码修改
    public function change(Request $request){

        if(Hash::check($request->oldPassword,auth()->user()->password)){
            auth()->user()->update([
                'password' => bcrypt($request->newPassword),
            ]);
            return [
                'status'=>"true",
                "message"=>"修改成功",
            ];
        }else{
            //修改失败
            return [
                'status'=>"false",
                "message"=>"旧密码错误"
            ];
        }
    }

    //忘记密码
    public function forget(Request $request){
        $tel=Member::where('tel',$request->tel)->first();
        if($tel){
            $code = Redis::get('code'.$request->tel);
            if ($request->sms != $code) {
                return [
                    "status" => "false",
                    "message" => "请输入正确的验证码"
                ];
            }
        }else{
            Member::where('tel',$request->tel->first())->update([
                'password' => bcrypt($request->password),
            ]);
            return [
                'status'=>"true",
                "message"=>"修改成功"
            ];
        }

    }

    //收获地址添加
    public function add(Request $request){
            Addresse::create([
          'id'=>$request->id,
         'user_id'=>Auth::user()->id,
         'province'=>$request->provence,
         'city'=>$request->city,
         'county'=>$request->area,
         'address'=>$request->detail_address,
         'name'=>$request->name,
         'tel'=>$request->tel,
         'is_default'=>$request->is_default,
            ]);
        return [
            "status"=>"true",
            "message"=>"添加成功"
        ];
    }
    //收获地址列表
    public function list(){
        $user_id=Auth::user()->id;
        $addresses=Addresse::where('user_id',$user_id)->get();
        $addrs=[];
        foreach ($addresses as $address){
            $addr=  [
                'user_id'=>Auth::user()->id,
                'id'=>$address->id,
                'provence'=>$address->province,
              'city'=>$address->city,
              'area'=>$address->county,
              'detail_address'=>$address->address,
              'name'=>$address->name,
              'tel'=>$address->tel,
            ];
            $addrs[]=$addr;
        }
      return $addrs;

    }
    //修改前获取一条数据
    public function edit(){
        $id=$_GET['id'];
        $addresses=Addresse::where('id',$id)->first();
        $data=[
            'id'=>$addresses->id,
            'provence'=>$addresses->province,
            'city'=>$addresses->city,
            'area'=>$addresses->county,
            'detail_address'=> $addresses->address,
            'name'=>$addresses->name,
            'tel'=>$addresses->tel
        ];
        return $data;
    }
    public function update(Request $request){
        $id=$request->id;
        Addresse::where('id',$id)->update([
            'province'=>$request->provence,
            'city'=>$request->city,
            'county'=>$request->area,
            'address'=>$request->detail_address,
            'name'=>$request->name,
            'tel'=>$request->tel,
        ]);
        return [
            "status"=>"true",
            "message"=>"修改成功"
        ];
    }

}
