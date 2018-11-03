<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //所属商家
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
