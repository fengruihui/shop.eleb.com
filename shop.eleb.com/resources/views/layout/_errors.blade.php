
@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>有错误信息!</strong>
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
         @endforeach
    </div>
@endif