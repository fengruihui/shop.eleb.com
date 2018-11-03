@extends('layout.defult')

@section('contents')
    <table border="1" class=" table table-bordered table-striped">


            <tr>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->shangjia->shop_name}}</td>

                <td>{{$menu->category_id}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>{{$menu->satisfy_rate}}</td>
                <td>@if($menu->goods_img)<img src="{{\Illuminate\Support\Facades\Storage::url($menu->goods_img)}}" width="20px"/>@endif</td>
                <td>{{$menu->status ?'上架':'下架'}}</td>
                <td>
                    <form action="{{route('menus.destroy',[$menu])}}" method="post">
                        <button class="btn-danger btn-xs" onclick="return confirm('确定要删除吗?')">删除</button>
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                    </form>
                    <a href="{{route('menus.edit',[$menu])}}">修改</a>
                    <a href="">查看</a>
                </td>
            </tr>

    </table>

@stop