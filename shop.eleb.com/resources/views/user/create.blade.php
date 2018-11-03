@extends('layout.defult')
@section('contents')
    @include('layout._errors')
<form method="post" action="{{route('land.store')}}" enctype="multipart/form-data">
    <div class="form-group">
        <label>帐号</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
        <label>密码</label>
        <input type="password" name="password" class="form-control" value="{{old('password')}}">
    </div>
    {{csrf_field()}}
    <div class="checkbox">
        <label><input type="checkbox" name="remember" @if(old('remember ')) checked="checked"@endif>记住密码</label>
    </div>
    <button class="btn-group-sm">登录</button>
</form>



@stop