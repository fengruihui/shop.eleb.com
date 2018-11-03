<?php

namespace App\Http\Controllers\User;

use App\Models\Addresse;
use App\Models\Cart;
use App\Models\MenCategory;
use App\Models\MenuCategory;
use App\Models\Menus;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //商家列表的信息
    public function list()
    {
        $shops = Shop::all();
        $datas = [];
        foreach ($shops as $shop) {
            $data = [
                "id" => $shop->id,
                "shop_name" => $shop->shop_name,
                "shop_img" => $shop->shop_img,
                "shop_rating" => $shop->shop_rating,
                "brand" => $shop->brand,
                "on_time" => $shop->on_time,
                "fengniao" => $shop->fengniao,
                "bao" => $shop->bao,
                "piao" => $shop->piao,
                "zhun" => $shop->zhun,
                "start_send" => $shop->start_send,
                "send_cost" => $shop->send_cost,
                "distance" => $shop->distance,
                "estimate_time" => $shop->estimate_time,
                "notice" => $shop->notice,
                "discount" => $shop->discount
            ];
            $datas[] = $data;
        }
        return $datas;
    }
    //获取指定的商家信息
    public function info(Request $request){
        $id = $request->id;
        $shop = Shop::find($id);
        $commodity = [];
        $categorys = MenuCategory::where('shop_id', $id)->get();
        foreach ($categorys as $category) {
            //遍历菜品
            $menus = Menus::where('category_id', $category->id)->get();
            $goods_list = [];
            //菜品
            foreach ($menus as $menu) {
                    $menudata = [
                        "goods_id" => $menu->id,
                        "goods_name" => $menu->goods_name,
                        "rating" => $menu->rating,
                        "goods_price" => $menu->goods_price,
                        "description" => $menu->description,
                        "month_sales" => $menu->month_sales,
                        "rating_count" => $menu->rating_count,
                        "tips" => $menu->tips,
                        "satisfy_count" => $menu->satisfy_count,
                        "satisfy_rate" => $menu->satisfy_rate,
                        "goods_img" => $menu->goods_img
                    ];

                //返回给菜品列表
                $goods_list[] = $menudata;
            }
            //分类、菜品表
            $categorydata=["description" => $category->description,
                "is_selected" => $category->is_selected == 1 ? true : false,
                "name" => $category->name,
                "type_accumulation" => $category->type_accumulation,
                "goods_list"=>$goods_list
            ];
            $commodity[]=$categorydata;
        }
        $shopdata = ["id" => $shop->id,
            "shop_name" => $shop->shop_name,
            "shop_img" => $shop->shop_img,
            "shop_rating" => $shop->shop_rating,
            "service_code" => 4.4,
            "foods_code" => 4.5,
            "high_or_low" => true,
            "h_l_percent" => 30,
            "brand" => $shop->brand == 1 ? true : false,
            "on_time" => $shop->brand == 1 ? true : false,
            "fengniao" => $shop->brand == 1 ? true : false,
            "bao" => $shop->brand == 1 ? true : false,
            "piao" => $shop->brand == 1 ? true : false,
            "zhun" => $shop->brand == 1 ? true : false,
            "start_send" => $shop->start_send,
            "send_cost" => $shop->send_cost,
            "distance" => 637,
            "estimate_time" => 31,
            "notice" => $shop->notice,
            "discount" => $shop->discount,
            "evaluate" => [[
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"
            ], [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 5,
                "send_time" => 30,
                "evaluate_details" => "很好吃" ]
            ],
            "commodity"=>$commodity,
        ];
        return $shopdata;
    }
    //订单添加
    public function addorder(Request $request){
       /* address_id: 地址id*/
       /* //查询地址表(address中的id)*/
        $address=Addresse::find($request->address_id);

      /*  //在查询cart表中用户购买的东西*/
        $carts=Cart::where('user_id',$address->user_id)->get();

        //把cart里的东西遍历出来
        $total=0;
        foreach ($carts as $cart){
            //购物车的goods_id查询出Menus和shop的信息
            $goods=Menus::find($cart->goods_id);
            $total+=($goods->goods_price)*($cart->amount);//菜品的价格*购物车的数量
        }
        //$shop_id-->购物车找最新的goods_id-->goods-->shop_id
        //查找购物车的goods_id->menus->中的商店(shop_id)
        $cart2=Cart::where('user_id',$address->user_id)->latest()->first();
        $shop_id=Menus::find($cart2->goods_id)->shop_id;
        //使用自动事务处理,同时添加orders表与oreder_details表的数据
        DB::transaction(function() use($address,$carts,$shop_id,$total){
            $order_id=DB::table('orders')->insertGetId([
                'user_id'=>$address->user_id,
                'shop_id'=>$shop_id,  //店铺id
                'sn'=>date("Ymdhis", time()).rand(1000,9999), //订单号
                'province'=>$address->province,
                'city'=>$address->city,
                'county'=>$address->county,
                'address'=>$address->address,
                'tel'=>$address->tel,
                'name'=>$address->name,
                'total'=>$total,
                'status'=>0,
                'created_at'=>date('y-m-d h:i:s',time()),
                'out_trade_no'=>str_random(10),  //第三方交易号,微信支付 待定
            ]);
            //订单详情表新增数据
            foreach($carts as $cart){
                //根据购物车的goods_id查出goods信息
                $goods=Menus::find($cart->goods_id);
                Order_detail::create([
                    'order_id'=>$order_id,
                    'goods_id'=>$goods->id,
                    'amount'=>$cart->amount,
                    'goods_name'=>$goods->goods_name,
                    'goods_img'=>$goods->goods_img,
                    'goods_price'=>$goods->goods_price,
                ]);
            }
            //购物车清空 删除购物车表里当前用户的数据
            DB::table('carts')->where('user_id',$address->user_id)->delete();
        });
        $order=Order::where('user_id',$address->user_id)->latest()->first();//得到最后一次加入的id
        return [
            "status"=> "true",
            "message"=>'添加成功',
            "order_id"=>$order->id,

        ];
    }
    //指定订单列表
    public function index(Request $request) {
        //记得接口名字要和路由对上
        $order = Order::find($request->id);
        $order_details=Order_detail::where('order_id',$order->id)->get();
        $goods_list=[];
        foreach ($order_details as $order_detail){
            $good=[
                "goods_list"=>$order_detail->goods_list,
                "goods_id"=>$order_detail->goods_id,
            "goods_name"=>$order_detail->goods_name,
            "goods_img"=>$order_detail->goods_img,
            "amount"=>$order_detail->amount,
            "goods_price"=>$order_detail->goods_price,
            ];
             $goods_list[]=$good;
        }
        return [
            'id'=>$order->id,
            'order_code'=>$order->sn,
            'order_birth_time'=>$order->created_at->format('Y-m-d H:i:s'),
            'order_status'=>"待付款",//* "order_code": 订单号
            'shop_id'=>$order->shop_id,
            'shop_name'=>$order->shop_name,
            'shop_img'=>$order->shop_img,
            'goods_list'=>$goods_list,
            'order_price'=>$order->total,
            'order_address'=>$order->province.$order->city.$order->county.' '.$order->address,
        ];
    }
        public function show(){
            //获取当前用户的订单
            $user_id=Auth::user()->id;
            $orders=Order::where('user_id',$user_id)->get();
            foreach ($orders as $order){
                //查询商家信息
                $shop = Shop::where('id',$order->shop_id)->first();
                //查询订单商品
                $order_details = Order_detail::where('order_id',$order->id)->get();
                foreach ($order_details as $order_detail){
                    return [
                        [
                            "id"=>$order->id,
                            "order_code"=> $order->sn,
                            "order_birth_time"=> $order->created_at->format('Y-m-d H:i:s'),
                            "order_status"=> $order->status,
                            "shop_id"=> $shop->id,
                            "shop_name"=> $shop->shop_name,
                            "shop_img"=> $shop->shop_img,
                            "goods_list"=> [
                                [
                                    "goods_id"=> $order_detail->goods_id,
                                    "goods_name"=> $order_detail->goods_name,
                                    "goods_img"=> $order_detail->goods_img,
                                    "amount"=> $order_detail->amount,
                                    "goods_price"=> $order_detail->goods_price,
                                ],
                            ],
                            "order_price"=>$order_detail->amount*$order_detail->goods_price,
                            "order_address"=>$order->province.$order->city.$order->county.' '.$order->address,
                        ]
                    ];

                }
            }
        }
}

