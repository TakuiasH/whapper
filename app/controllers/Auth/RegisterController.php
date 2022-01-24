<?php

use app\services\AuthenticationService;
use bootstrap\models\Controller;
use bootstrap\models\Request;

class RegisterController implements Controller {

    public function index() {
        view("auth.register");
    }

    public function register(Request $req) {
        $response = AuthenticationService::register($req->post()->username, $req->post()->email, $req->post()->password, $req->post()->repassword);

        if($response->success()){
            $role = "success";
            
            $message = __("auth.register@success");
        }else {
            $role = "danger";

            if($response->passwordsNotMatch()) $message = __("auth.register@password_match");
            if($response->passwordSmall()) $message = __("auth.register@password_small");
            if($response->emailTaken()) $message = __("auth.register@email_taken");
            if($response->usernameTaken()) $message = __("auth.register@username_taken");
        }

        view("auth.register", [$role => $message]);
    }
}