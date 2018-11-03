<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::all();
        return view('order.index',['orders'=>$orders]);
    }
    public function list(Order $order){
        return view('order.show',['order'=>$order]);
    }
    public function wait(){
        $waits=Order::where('status',0)->get();
        return view('order.wait',['waits'=>$waits]);
    }
   /* public function finish(Order $order){
        $order->update([
            'status'=>3
        ]);
        session()->flash('success','发货成功');
        return redirect(route('wait',['order'=>$order]));
    }*/
    //最近一周订单统计量
   public function weekend(){
        $shop_id=Auth::user()->shop_id;
        Order::where('shop_id',$shop_id)->get();
    }
}
