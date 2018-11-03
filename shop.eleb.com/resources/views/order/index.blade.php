@extends('layout.defult')

@section('contents')
 <h1>订单管理</h1>
    <table border="1" class=" table table-bordered table-striped">
        <tr>
            <td>用户名</td>
            <td>操作</td>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{$order->name}}</td>
                <td><button><a href="{{route('list',[$order])}}">订单详情</a></button></td>
            </tr>
        @endforeach
    </table>
@stop