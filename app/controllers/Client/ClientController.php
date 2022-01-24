<?php

use app\services\AuthenticationService;
use bootstrap\models\Controller;
use bootstrap\models\Request;
use bootstrap\services\Route;

class ClientController implements Controller {

    public function index() {
        view("auth.client");
    }
}