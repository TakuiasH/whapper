<?php

use app\services\AuthenticationService;
use bootstrap\models\Controller;
use bootstrap\models\Request;

class ForgotController implements Controller {

    public function index() {
        view("auth.forgot");
    }

    public function forgot(Request $req) {
        $response = AuthenticationService::forgot($req->post()->email);

        if($response->success()){
            $role = "success";
            $message = __("auth.forgot@success");

        }else {
            $role = "danger";
            $message = __("auth.forgot@mail_error");
        }

        view("auth.forgot", [$role => $message]);
    }
    
}