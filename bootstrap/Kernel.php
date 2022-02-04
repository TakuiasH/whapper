<?php namespace bootstrap;

use bootstrap\providers\RouteProvider;
use bootstrap\services\DB;
use bootstrap\services\Locale;

class Kernel {
        
    public function __construct() {     
        ini_set('display_errors', 'On');

        require_once("../app/models/Auth.php");

        session_start();
                
        define("app", include('../config/app.php'));
        define("mail_config", include('../config/mail.php'));
        define("database_config", include('../config/database.php'));
        
        new Locale();
        new DB();
        new RouteProvider();
    }
}
