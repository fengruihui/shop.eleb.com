@extends('layout.defult')
@section('contents')
    <h1>商家密码修改</h1>
    <form method="post" action="{{route('change.save',[$user])}}" enctype="multipart/form-data">
        <div class="form-group">

            <div class="form-group form-inline">
                <label>原密码</label>
                <input type="password" name="old_password" class="form-control" value="">{{$errors->first('old_password')}}
            </div>
            <div class="form-group form-inline">
                <label>新密码</label>
                <input type="password" name="password" class="form-control" value="">{{$errors->first('password')}}
            </div>

            <div class="form-group form-inline">
                <label>确认密码</label>
                <input type="password" name="password_confirmation" class="form-control" value="">{{$errors->first('password_confirmation')}}
            </div>
        </div>
        {{csrf_field()}}

        <button class="btn-block btn-sm">提交</button>
    </form>
@stop