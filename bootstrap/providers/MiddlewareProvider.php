<?php namespace bootstrap\providers;

use bootstrap\models\Middleware;

class MiddlewareProvider {

    public static function findMiddleware(string $name) : Middleware | null {
        require_once "..\bootstrap\models\Middleware.php";

        foreach(scandir("../app/middlewares") as $value) {
            if(str_ends_with($value, ".php")){
                require_once "..\app\middlewares\\".$value;
                $class = str_replace(".php", "", $value);
                $instance = new $class;
                if($instance instanceof Middleware)
                    if($instance->name() === $name)
                        return $instance;
            }
        }

        return null;
    }

}