<?php

use app\services\AuthenticationService;
use bootstrap\models\Middleware;
use bootstrap\services\Route;

class GuestMiddleware extends Middleware {


    function __construct() {
        parent::__construct("guest");
    }

    function validate() : bool { //check if player is logged in
        if(AuthenticationService::isLoggedIn()){
            return true;
        }else {
            Route::redirect(AuthenticationService::$login_page);
            return false;
        }
    }
}