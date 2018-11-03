@extends('layout.defult')

@section('contents')
    <h1>订单管理</h1>
    <table border="1" class=" table table-bordered table-striped">
        <tr>
            <td>用户名</td>
            <td>联系电话</td>
            <td>操作</td>
        </tr>
        @foreach ($waits as $wait)
            <tr>
                <td>{{$wait->name}}</td>
                <td>{{$wait->tel}}</td>
                <td><button><a href="{{route('finish',[$wait])}}">发货</a></button></td>
            </tr>
        @endforeach
    </table>
@stop