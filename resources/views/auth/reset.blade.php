@extends('auth.layout')

@section('title', __("auth.reset@title"))

@section('content')
<form method="POST">

    @include('models.feedback')
    
    <div class="form-group justify-content-center row">
        <div class="col-md-6">
            <label for="email">{{__("auth.reset@email")}}</label>
            <input type="email" id="email" class="form-control" @if(!empty($email))value="{{$email}}"@endif name="email" required>
        </div>
    </div>
    
    <div class="form-group justify-content-center row">
        <div class="col-md-6">
            <label for="token">{{__("auth.reset@token")}}</label>
            <input type="text" id="token" class="form-control" @if(!empty($token))value="{{$token}}"@endif name="token" required>
        </div>
    </div>
   
    <div class="form-group justify-content-center row">
        <div class="col-md-3">
            <label for="password">{{__("auth.reset@password")}}</label>
            <input type="password" id="password" class="form-control" name="password" required>
        </div>
        <div class="col-md-3">
            <label for="repassword">{{__("auth.reset@repassword")}}</label>
            <input type="password" id="repassword" class="form-control" name="repassword" required>
        </div>
    </div>  
    
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="width: 25%;">
            {{__("auth.reset@submit")}}
        </button>
    </div>
    
    <div class="row text-center justify-content-center">
        <div class="col-md-3">
            <a href="/auth/login" class="btn btn-link">
                {{__("auth.reset@have_account")}}
            </a>
        </div>
        <div class="col-md-3">
            <a href="/auth/register" class="btn btn-link">
                {{__("auth.reset@create_account")}}
            </a>
        </div>
    </div>
</form>
@endsection