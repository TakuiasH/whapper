@if(!empty($danger))
    <div class="alert alert-danger text-center" role="alert">{{$danger}}</div>
@endif
@if(!empty($success))
    <div class="alert alert-success text-center" role="alert">{{$success}}</div>
@endif
@if(!empty($info))
    <div class="alert alert-info text-center" role="alert">{{$info}}</div>
@endif
@if(!empty($warn))
    <div class="alert alert-warn text-center" role="alert">{{$warn}}</div>
@endif