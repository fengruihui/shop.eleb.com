@extends('layout.defult')
@section('contents')
    <h1>菜品分类添加</h1>
    <form method="post" action="{{route('menucategory.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-group form-inline">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">{{$errors->first('name')}}
            </div>

            <div class="form-group form-inline">
                <label>菜品描述</label>
                <textarea name="description"></textarea>
            </div>
            <div class="form-group form-inline">
                <label><h3>是否是默认分类</h3></label>
                <input type="radio" name="is_selected" class="form-control" value="1">是{{$errors->first('is_selected')}}
                <input type="radio" name="is_selected" class="form-control" value="0">不是
            </div>
        </div>
        {{csrf_field()}}
        <button class="btn-block btn-sm">提交</button>
    </form>
@stop