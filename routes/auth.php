<?php

use bootstrap\services\Route;

Route::get("auth/login", "Auth.LoginController@index", ['auth']);
Route::post("auth/login", "Auth.LoginController@login", ['auth']);

Route::get("auth/register", "Auth.RegisterController@index", ['auth']);
Route::post("auth/register", "Auth.RegisterController@register", ['auth']);

Route::get("auth/forgot", "Auth.ForgotController@index", ['auth']);
Route::post("auth/forgot", "Auth.ForgotController@forgot", ['auth']);

Route::get("auth/reset", "Auth.ResetController@index", ['auth']);
Route::post("auth/reset", "Auth.ResetController@reset", ['auth']);

Route::any("auth/logout", "Auth.LogoutController@index");

Route::any("client", "Client.ClientController@index", ['guest']);

