<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Menucategory extends Model
{
    protected $fillable=['name','shop_id','is_selected','type_accumulation','description','search'];


    public function Category(){
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
