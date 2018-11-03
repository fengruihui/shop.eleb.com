@extends('layout.defult')
@section('contents')
    @include('layout._errors')
    <form class="form-horizontal" action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <h1>添加店铺信息</h1>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-10">
                <select class="form-control" name="shop_category_id">
                   @foreach($shopCategorys as $shopCategory)
                        <option  {{$shopCategory->id==old('shop_category_id')?'selected':''}} value="{{$shopCategory->id}}">{{$shopCategory->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺名称</label>
            <div class="col-sm-10">
                <input type="text" name="shop_name" class="form-control" id="inputEmail3" placeholder="名称"
                       value="{{ old('shop_name') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">店铺图片</label>
            <input type="file" name="shop_img" />
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">服务</label>
            <div class="col-sm-10">

                <label class="checkbox-inline">
                    <input type="checkbox" name="brand" id="inlineCheckbox1" value="1">是否是品牌
                </label>

                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="1" name="on_time"> 是否准时送达
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox3" value="1" name="fengniao"> 是否蜂鸟配送
                </label>

                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox3" value="1" name="bao" {{ old('bao')? 'checked' :'' }}> 是否保标记
                </label>

                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox3" value="1" name="piao"> 是否票标记
                </label>

                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox3" value="1" name="zhun"> 是否准标记
                </label>

            </div>
        </div>


        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-10">
                <input type="number" name="start_send" class="form-control" id="inputEmail3" placeholder="起送金额" value="{{ old('start_send') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-10">
                <input type="number" name="send_cost" class="form-control" id="inputEmail3" placeholder="配送费" value="{{ old('send_cost') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="notice" rows="3">{{ old('notice') }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="discount" rows="3">{{ old('discount') }}</textarea>
            </div>
        </div>


        <h1>添加商家账号</h1>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="用户名" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="邮箱" value="{{ old('email') }}">
            </div>
        </div>


        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="密码">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" id="inputEmail3" placeholder="确认密码">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">增加商家账号与入驻商铺</button>
            </div>
        </div>
    </form>
@stop