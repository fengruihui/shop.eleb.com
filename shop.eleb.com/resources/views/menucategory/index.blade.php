@extends('layout.defult')

@section('contents')
    <table border="1" class=" table table-bordered table-striped">
        <tr>
            <td>菜品名称</td>
            <td>菜品编号</td>
            <td>所属商家ID</td>
            <td>菜品描述</td>
            <td>菜品是否是默认分类</td>
            <td>操作</td>

        </tr>
            @foreach($menucategorys as $menucategory)
            <tr>
                <td>{{$menucategory->name}}</td>
                <td>{{$menucategory->type_accumulation}}</td>
                 {{--<td>{{$menucategory->shop_id}}</td>--}}
                <td>{{$menucategory->Category->shop_name}}</td>
                <td>{{$menucategory->description}}</td>
                <td>{{$menucategory->is_selected?'是':'不是'}}</td>
                <td>
                    <form action="{{route('menucategory.destroy',[$menucategory])}}" method="post">
                        <button class="btn-danger btn-xs" onclick="return confirm('确定要删除吗?')">删除</button>
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                    </form>
                    <a href="{{route('menucategory.edit',[$menucategory])}}">修改</a>

                </td>
            </tr>
               @endforeach
    </table>
{{$menucategorys->links()}}
@stop