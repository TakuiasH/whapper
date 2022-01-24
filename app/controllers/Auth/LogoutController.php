<?php

use app\services\AuthenticationService;
use bootstrap\models\Controller;
use bootstrap\services\Route;

class LogoutController implements Controller {

    public function index() {
        AuthenticationService::logout();
        Route::redirect(AuthenticationService::$login_page);
    }
    
}