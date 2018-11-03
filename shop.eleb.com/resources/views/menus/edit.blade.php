@extends('layout.defult')
@section('contents')
    <h1>菜品修改</h1>
    <form method="post" action="{{route('menus.update',[$menu])}}" enctype="multipart/form-data">

        <div class="form-group">
            <label>菜品名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ $menu->goods_name}}">
        </div>
        <div class="form-group">
            <label>图片</label>
            @if($menu->goods_img)<img src="{{\Illuminate\Support\Facades\Storage::url($menu->goods_img)}}" width="50px"/>@endif<input type="file" name="goods_img" class="form-group-sm">
        </div>

        <div class="form-group">
            <label>菜品评分</label>
            <input type="text" name="rating" class="form-control"  value="{{ $menu->rating}}">
        </div>
        <div class="form-group">
            <label>所属分类</label>
            <select name="category_id" class="form-control">
                <option value="">请选择菜品分类</option>

                @foreach($menucategorys as $menucategory)
                    <option value="{{$menucategory->id}}"
                            @if($menucategory->id==$menu->category_id)selected="selected"@endif>{{$menucategory->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格</label>
            <input type="text" name="goods_price" class="form-control"  value="{{$menu->goods_price}}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="description" class="form-control"  value="{{$menu->description}}">
        </div>
        <div class="form-group">
            <label>月销量</label>
            <input type="text" name="month_sales" class="form-control"  value="{{$menu->month_sales}}">
        </div>
        <div class="form-group">
            <label>评分数量</label>
            <input type="text" name="rating_count" class="form-control" value="{{$menu->rating_count}}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{$menu->tips}}">
        </div>
        <div class="form-group">
            <label>满意度数量</label>
            <input type="text" name="satisfy_count" class="form-control" value="{{$menu->satisfy_count}}" >
        </div>
        <div class="form-group">
            <label>满意度评分</label>
            <input type="text" name="satisfy_rate" class="form-control" value="{{$menu->satisfy_rate}}">
        </div>
        <div class="form-group form-inline">
            <label><h3>是否上架</h3></label>
            <input type="radio" name="status" class="form-control" value="1" @if($menu->status==1) checked="checked" @endif>上架{{$errors->first('status')}}
            <input type="radio" name="status" class="form-control" value="0" @if($menu->status==0) checked="checked" @endif>下架
        </div>

        {{csrf_field()}}
        {{method_field('put')}}
        <button class="btn-block btn-sm">提交</button>
    </form>
@stop