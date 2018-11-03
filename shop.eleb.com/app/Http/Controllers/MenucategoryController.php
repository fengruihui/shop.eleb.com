<?php

namespace App\Http\Controllers;

use App\Models\Menucategory;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenucategoryController extends Controller
{


    public function index(){
       if(Auth::user()==null){
            return redirect(route('land'))->with('danger','必须得登录');
        }
        $shop_id=Auth::user()->shop_id;

        $menucategorys=Menucategory::where('shop_id',$shop_id)->paginate(2);
        return view('menucategory.index',['menucategorys'=>$menucategorys]);
    }

    public function show(){

    }

    public function create(){
        return view('menucategory.add');
    }
    public function store(Request $request){
        Menucategory::create([
            'name'=>$request->name,
            'type_accumulation'=>mt_rand(10,100),
            'description'=>$request->description,
            'shop_id' => Auth::user()->shop_id,
            'is_selected'=>$request->is_selected??0
        ]);
        session()->flash('success','添加成功');
        return redirect(route('menucategory.index'));
    }
    public function edit(Menucategory $menucategory){
           return view('Menucategory.edit',['menucategory'=>$menucategory]);
    }
    public function update(Menucategory $menucategory,Request $request){
       $menucategory->update([

           'name'=>$request->name,
           'description'=>$request->description,
           'is_selected'=>$request->is_selected??0
       ]);
       session()->flash('success','修改陈功');
        return redirect(route('menucategory.index'));
    }
    public function destroy(Menucategory $menucategory){

        $menus=Menus::where('category_id',$menucategory->id)->get();

        if (count($menus)!=0){
            session()->flash('success','分类下有菜品不能删哦');
            return redirect(route('menucategory.index'));
        }else{
            $menucategory->delete();
            session()->flash('success','删除功');
            return redirect(route('menucategory.index'));
        }

    }

}
