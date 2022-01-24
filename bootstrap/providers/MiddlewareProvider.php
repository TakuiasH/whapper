<?php namespace bootstrap\providers;

use bootstrap\models\Middleware;

class MiddlewareProvider {

    public static function findMiddleware(string $name) : Middleware {
        require_once "..\bootstrap\models\Middleware.php";

        foreach(scandir("../app/middlewares") as $value) {
            if(str_ends_with($value, ".php")){
                require_once "..\app\middlewares\\".$value;

                $instance = new (str_replace(".php", "", $value))();
                if($instance instanceof Middleware)
                    if($instance->name() === $name)
                        return $instance;
            }
        }

        return null;
    }

}