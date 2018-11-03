<?php

namespace App\Http\Controllers;

use App\Models\Activ;
use App\Models\Menucategory;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenusController extends Controller
{
    public function search(Request $request){
        $shop_id=Auth::user()->shop_id;
        //$menus=Menus::where('shop_id',$shop_id)->where('goods_name','like',"%$request->goods_name%")->paginate(2);
       $wheres=[];
       if($request->goods_name){
           $wheres[]=['goods_name','like',"%$request->goods_name%"];
       }
       if($request->price1){
           $wheres[]=['goods_price','>=',$request->price1];
       }
       if($request->price2){
           $wheres[]=['goods_price','<=',$request->price2];
       }
       $menus=Menus::where($wheres)->where('shop_id',$shop_id)->paginate(2);
        return view('menus.index',['menus'=>$menus]);
    }

    public function index(){
       /* if(Auth::user()==null){
           return redirect(route('land'))->with('danger','必须得登录');
       }*/

       $shop_id=Auth::user()->shop_id;
        $menus=Menus::where('shop_id',$shop_id)->paginate(2);
        return view('menus.index',['menus'=>$menus]);
    }
    //添加菜单
    public function create(){
        $menucategorys=Menucategory::all();
        return view('menus.create',['menucategorys'=>$menucategorys]);
    }
    public function store(Request $request){
        $path=$request->file('goods_img')->store('public/menus');
        Menus::create([
            'goods_name' => $request->goods_name,
            'goods_img' => $path,
            'rating' => $request->rating,
            'shop_id' => Auth::user()->shop_id,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'status' => $request->status,
        ]);
        session()->flash('success','添加成功');
        return redirect(route('menus.index'));
    }

//修改菜品
    public function edit(Menus $menu){

        $menucategorys=Menucategory::all();
        return view('menus.edit',['menu'=>$menu],['menucategorys'=>$menucategorys]);
    }
    public function update(Menus $menu,Request $request){
        if($request->goods_img=$request->file('goods_img')) { //判断是否有图片没有就修改

            $path=$request->file('goods_img')->store('public/menus');

            $menu->update([
                'goods_name' => $request->goods_name,
                'goods_img' => $path,
                'rating' => $request->rating,
                'shop_id' => Auth::user()->shop_id,
                'category_id' => $request->category_id,
                'goods_price' => $request->goods_price,
                'description' => $request->description,
                'month_sales' => $request->month_sales,
                'rating_count' => $request->rating_count,
                'tips' => $request->tips,
                'satisfy_count' => $request->satisfy_count,
                'satisfy_rate' => $request->satisfy_rate,
                'status' => $request->status,
            ]);
        }else{
            $menu->update([
                'goods_name' => $request->goods_name,
                'rating' => $request->rating,
                'shop_id' => Auth::user()->shop_id,
                'category_id' => $request->category_id,
                'goods_price' => $request->goods_price,
                'description' => $request->description,
                'month_sales' => $request->month_sales,
                'rating_count' => $request->rating_count,
                'tips' => $request->tips,
                'satisfy_count' => $request->satisfy_count,
                'satisfy_rate' => $request->satisfy_rate,
                'status' => $request->status, ]);
        }
        session()->flash('success','修改成功');
        return redirect(route('menus.index'));
    }
    public function destroy(Menus $menu){
        $menu->delete();
        session()->flash('success','删除成功');
        return redirect(route('menus.index'));
    }

    public function see(){
        $activs=Activ::where('end_time','>',date('Y-m-d H:i:s',time()))->get();
        return view('activ.index',['activs'=>$activs]);
    }

    public function show(Activ $activ){
        return view('activ.show',['activ'=>$activ]);
    }

}
