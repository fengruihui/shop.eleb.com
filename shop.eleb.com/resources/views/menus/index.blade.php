@extends('layout.defult')

@section('contents')
    <table border="1" class=" table table-bordered table-striped">
        <form class="navbar-form "  action="{{route('search')}}" method="get">
            {{csrf_field()}}
            <div class="form-group form-inline">
                <input type="text" class="form-control" placeholder="Search" name="goods_name">
                <label for="">价格区间</label>
                <input type="text" class="form-control" name="price1">--
                <input type="text" class="form-control" name="price2">
                <button type="submit" class="form-control"><span class="glyphicon glyphicon-search"></span></button>
            </div>
        </form>

        <tr>
            <td>菜品名称</td>
            <td>评分</td>
            <td>所属商家ID</td>
            <td>所属分类</td>
            <td>价格</td>
            <td>描述</td>
            <td>月销量</td>
            <td>评分数量</td>
            <td>提示信息</td>
            <td>满意度数量</td>
            <td>满意度评分</td>
            <td>商品图片</td>
            <td>是否上架</td>
            <td>操作</td>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->shangjia->shop_name}}</td>

                {{--<td>{{$menu->category_id}}</td>--}}
                <td>{{$menu->fenlei->name}}</td>

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
                    <button class="btn-danger btn-xs"><a href="{{route('menus.edit',[$menu])}}" style="text-decoration: none">修改</a></button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menus->links()}}
@stop