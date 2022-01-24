<?php

use app\services\AuthenticationService;
use bootstrap\models\Controller;
use bootstrap\models\Request;

class ResetController implements Controller {

    public function index(Request $req) {
        $email = "";
        if(isset($req->get()->email))
            $email = $req->get()->email;

        $token = "";
        if(isset($req->get()->token))
            $token = $req->get()->token;

        view("auth.reset", ["email" => $email, "token" => $token]);
    }
    
    public function reset(Request $req) {
        $response = AuthenticationService::reset($req->post()->email, $req->post()->token, $req->post()->password, $req->post()->repassword);
        
        if($response->success()){
            $role = "success";
            $message = __("auth.reset@success");
        }else {
            $role = "danger";

            if($response->passwordsNotMatch()) $message = __("auth.reset@password_match");
            if($response->passwordSmall()) $message = __("auth.reset@password_small");
            if($response->emailInvalid()) $message = __("auth.reset@email_invalid");
            if($response->tokenInvalid()) $message = __("auth.reset@token_invalid");
        }
        view("auth.reset", [$role => $message]);
    }
}