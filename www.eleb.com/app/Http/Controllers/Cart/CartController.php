<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use App\Models\Menus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller{
    //添加购物车
    public function add(Request $request){
        $user_id = Auth::user()->id;
        $goodsList = $request->goodsList;
        $goodsCount = $request->goodsCount;
        foreach ($goodsList as $k => $goods_id){
            $amount = $goodsCount[$k];
            //检查购物车中是否有该商品,有的话累加数量,没有的话添加
            $cart = Cart::where('user_id',$user_id)->where('goods_id',$goods_id)->first();
            if($cart){
                $cart->update(['amount'=>$cart->amount+$amount]);
            }else{
                Cart::create([
                    'user_id'=>$user_id,
                    'goods_id'=>$goods_id,
                    'amount'=>$amount,
                ]);
            }

        }
        return [
            "status"=> "true",
            "message"=> "添加成功"
        ];
    }
    //获取购物车数据接口
    public function cartlist()
    {
        //dd('nihao');
        $goods_list = [];
        $money=0;
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',$user_id)->get();
        foreach ($carts as $cart) {
            $menu = Menus::find($cart->goods_id);
            $goods_list[]=[
                    'goods_id'=>$menu->id,
                    'goods_name'=>$menu->goods_name,
                    'goods_img'=>$menu->goods_img,
                    'amount'=>$cart->amount,
                    'goods_price'=>$menu->goods_price,
                ];
            $money+=($cart->amount)*$menu->goods_price;
        }
        return[
            'goods_list'=>$goods_list,
            'totalCost'=>$money//价钱
        ];
    }

}
