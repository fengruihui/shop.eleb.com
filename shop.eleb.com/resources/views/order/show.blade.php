@extends('layout.defult')

@section('contents')
    <h1>订单管理</h1>
    <table border="1" class=" table table-bordered table-striped">
        <tr>
            <td>所属商店</td>
            <td>订单编号</td>
            <td>价格</td>
            <td>所属省</td>
            <td>所属县</td>
            <td>所在地址</td>
            <td>联系电话</td>
            <td>状态</td>

        </tr>
            <tr>
                <td>{{$order->shop->shop_name}}</td>
                <td>{{$order->sn}}</td>
                <td>{{$order->total}}元</td>
                <td>{{$order->province}}</td>
                <td>{{$order->county}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->tel}}</td>
                <td>@if($order->status==0)待支付@elseif($order->status==1)待发货@elseif($order->status==2)待确认@elseif($order->status==3)完成@endif</td>
                状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)
            </tr>
    </table>
@stop