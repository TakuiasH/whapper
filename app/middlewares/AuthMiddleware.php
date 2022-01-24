<?php

use app\services\AuthenticationService;
use bootstrap\models\Middleware;
use bootstrap\services\Route;

class AuthMiddleware extends Middleware {

    function __construct() {
        parent::__construct("auth");
    }

    function validate() : bool { //check if player is not logged in
        if(!AuthenticationService::isLoggedIn()){
            return true;
        }else {
            Route::redirect(AuthenticationService::$client_page);
            return false;
        }
    }
}