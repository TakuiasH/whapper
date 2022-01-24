@extends('auth.layout')

@section('title', __("auth.login@title"))

@section('content')
<form method="POST">

    @include('models.feedback')
    
    <div class="form-group justify-content-center row">
        <div class="col-md-6 ">
            <label for="email_address">{{__("auth.login@username")}}</label>
            <input type="text" id="username" class="form-control" name="username" required autofocus>
        </div>
    </div>

    <div class="form-group justify-content-center row">
        <div class="col-md-6">
            <label for="password">{{__("auth.login@password")}}</label>
            <input type="password" id="password" class="form-control" name="password" required>
        </div>
    </div>

    <div class="form-group justify-content-center row">
        <div class="col-md-6">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> {{__("auth.login@remember")}}
                </label>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="width: 25%;">
            {{__("auth.login@submit")}}
        </button>
    </div>
    
    <div class="row text-center justify-content-center">
        <div class="col-md-3">
            <a href="/auth/forgot" class="btn btn-link">
                {{__("auth.login@forgot_password")}}
            </a>
        </div>
        <div class="col-md-3">
            <a href="/auth/register" class="btn btn-link">
                {{__("auth.login@create_account")}}
            </a>
        </div>
    </div>
</form>
@endsection