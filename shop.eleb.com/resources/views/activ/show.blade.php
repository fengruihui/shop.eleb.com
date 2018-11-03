@extends('layout.defult')

@section('contents')
    <table border="1" class=" table table-bordered table-striped">
        <tr>
            <td>{!! $activ->content !!}</td>
        </tr>
    </table>
@stop