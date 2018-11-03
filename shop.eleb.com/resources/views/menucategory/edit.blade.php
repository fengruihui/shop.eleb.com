@extends('layout.defult')
@section('contents')
    <h1>菜品分类修改</h1>
    <form method="post" action="{{route('menucategory.update',[$menucategory])}}" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-group form-inline">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control" value="{{$menucategory->name}}">{{$errors->first('name')}}
            </div>

            <div class="form-group form-inline">
                <label>菜品描述</label>
                <textarea name="description">{{$menucategory->description}}</textarea>
            </div>
            <div class="form-group form-inline">
                <label><h3>是否是默认分类</h3></label>
                <input type="radio" name="is_selected" class="form-control" value="1" @if($menucategory->is_selected==1)checked="checked"@endif>是{{$errors->first('is_selected')}}
                <input type="radio" name="is_selected" class="form-control" value="0" @if($menucategory->is_selected==0) checked="checked"@endif>不是
            </div>
        </div>
        {{csrf_field()}}
        {{method_field('put')}}
        <button class="btn-block btn-sm">提交</button>
    </form>
@stop