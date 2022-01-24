@extends('auth.layout')

@section('title', __("auth.register@title"))

@section('content')
<form method="POST">
    @include('models.feedback')

    <div class="form-group justify-content-center row">
        <div class="col-md-6 ">
            <label for="email_address">{{__("auth.register@username")}}</label>
            <input type="text" id="username" class="form-control" name="username" required autofocus>
        </div>
    </div>

    <div class="form-group justify-content-center row">
        <div class="col-md-6 ">
            <label for="email_address">{{__("auth.register@email")}}</label>
            <input type="email" id="email" class="form-control" name="email" required autofocus>
        </div>
    </div>
    
    <div class="form-group justify-content-center row">
        <div class="col-md-3">
            <label for="password">{{__("auth.register@password")}}</label>
            <input type="password" id="password" class="form-control" name="password" required>
        </div>
        <div class="col-md-3">
            <label for="repassword">{{__("auth.register@repassword")}}</label>
            <input type="password" id="repassword" class="form-control" name="repassword" required>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="width: 25%;">
            {{__("auth.register@submit")}}
        </button>

    </div>
    
    <div class="row text-center justify-content-center">
        <div class="col-md-3">
            <a href="/auth/forgot" class="btn btn-link">
                {{__("auth.register@forgot_password")}}
            </a>
        </div>
        <div class="col-md-3">
            <a href="/auth/login" class="btn btn-link">
                {{__("auth.register@have_account")}}
            </a>
        </div>
    </div>
</form>
@endsection