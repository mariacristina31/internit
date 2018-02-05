@if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Success!</strong> {{ Session::get('flash_message') }}
</div>
@endif
@if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{$error}}
</div>
@endforeach
@endif
