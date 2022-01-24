<?php

use app\services\AuthenticationService;
use bootstrap\services\Route;

Route::get("auth/login", "auth.LoginController@index", ['auth']);
Route::post("auth/login", "auth.LoginController@login", ['auth']);

Route::get("auth/register", "auth.RegisterController@index", ['auth']);
Route::post("auth/register", "auth.RegisterController@register", ['auth']);

Route::get("auth/forgot", "auth.ForgotController@index", ['auth']);
Route::post("auth/forgot", "auth.ForgotController@forgot", ['auth']);

Route::get("auth/reset", "auth.ResetController@index", ['auth']);
Route::post("auth/reset", "auth.ResetController@reset", ['auth']);

Route::any("auth/logout", "auth.LogoutController@index");

Route::any("client", "client.ClientController@index", ['guest']);

