<?php

use app\services\AuthenticationService;
use bootstrap\models\Controller;
use bootstrap\models\Request;
use bootstrap\services\Route;

class LoginController implements Controller {

    public function index() {
        view("auth.login");
    }

    public function login(Request $req) {
        $response = AuthenticationService::login($req->post()->username, $req->post()->password, isset($req->post()->remember));

        if($response->success()){
            Route::redirect(AuthenticationService::$client_page);
        }else {
            if($response->passwordInvalid()) $message = __("auth.login@password_wrong");
            if($response->usernameInvalid()) $message = __("auth.login@account_not_exists");

            view("auth.login", ["danger" => $message]);
        }
        
    }
}