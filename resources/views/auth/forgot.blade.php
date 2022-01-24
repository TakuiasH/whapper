@extends('auth.layout')

@section('title', __("auth.forgot@title"))

@section('content')
<form method="POST">

    @include('models.feedback')
    
    <div class="form-group justify-content-center row">
        <div class="col-md-6">
            <label for="email">{{__("auth.forgot@email")}}</label>
            <input type="email" id="email" class="form-control" name="email" required>
        </div>
    </div>

   
    <div class="text-center">
        <button type="submit" class="btn btn-primary" style="width: 25%;">
            {{__("auth.forgot@submit")}}
        </button>

    </div>
    
    <div class="row text-center justify-content-center">
        <div class="col-md-3">
            <a href="/auth/login" class="btn btn-link">
                {{__("auth.forgot@have_account")}}
            </a>
        </div>
        <div class="col-md-3">
            <a href="/auth/register" class="btn btn-link">
                {{__("auth.forgot@create_account")}}
            </a>
        </div>
    </div>
</form>
@endsection