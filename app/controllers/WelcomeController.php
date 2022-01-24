<?php

use bootstrap\models\Controller;

class WelcomeController implements Controller {

    public function index() {
        view("welcome");
    }

}