<?php

use bootstrap\services\DB;
use bootstrap\services\Route;

Route::get("", "WelcomeController@index");

Route::get("migrations/make", function() {  DB::executeMigrations(); });
Route::get("migrations/drop", function() {  DB::dropMigrations(); });

Route::any404(function() { view("errors.404"); });