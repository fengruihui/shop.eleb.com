<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $fillable=['goods_name','rating','shop_id','category_id','goods_price','description','month_sales',
        'rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'
        ,'search'];


    //所属商家
    public function shangjia(){
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
    //分类id
    public function fenlei(){
        return $this->belongsTo(Menucategory::class,'category_id','id');
    }
}
