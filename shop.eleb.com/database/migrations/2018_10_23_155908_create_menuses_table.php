<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuses', function (Blueprint $table) {
                        /*goods_name	string	名称
            rating	float	评分
            shop_id	int	所属商家ID
            category_id	int	所属分类ID
            goods_price	float	价格
            description	string	描述
            month_sales	int	月销量
            rating_count	int	评分数量
            tips	string	提示信息
            satisfy_count	int	满意度数量
            satisfy_rate	float	满意度评分
            goods_img	string	商品图片
            status*/
            $table->increments('id');
            $table->string('goods_name');
            $table->float('rating');
            $table->integer('shop_id');
            $table->integer('category_id');
            $table->float('goods_price');
            $table->string('description');
            $table->integer('month_sales');
            $table->integer('rating_count');
            $table->string('tips');
            $table->string('satisfy_count');
            $table->float('satisfy_rate');
            $table->string('goods_img');
            $table->integer('status');
            $table->engine='innoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuses');
    }
}
