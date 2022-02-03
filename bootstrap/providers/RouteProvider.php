<?php namespace bootstrap\providers;

use bootstrap\models\Request;
use bootstrap\services\Route;

class RouteProvider {
	
    private function loadRoutes() {
        
        /*
         * List here all the route files you want to load.
         */
        require_once '../routes/auth.php';
        require_once '../routes/web.php';
    }
    
    public function __construct() {
        require_once 'ViewProvider.php';
        
        $this->loadRoutes();
        
        $path = Route::currentPath();
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset(Route::$routes['ANY'][$path])) {
            $this->makeRoute('ANY', $path);
        } else if (isset(Route::$routes[$method][$path])) {
            $this->makeRoute($method, $path);
        } else {
            $this->makeRoute('ANY', 'error_404');
        }
    }
    
    private function makeRoute(string $method, string $path){
        $route = Route::$routes[$method][$path];

        $request = new Request($_GET, $_POST, $method, Route::currentPath());

        if(!empty($route['middleware'])){
            foreach($route['middleware'] as $name){
                $middleware = MiddlewareProvider::findMiddleware($name);
                
                if($middleware != null && !$middleware->validate()){
                    echo $middleware->name() . " not validated";
                    return;
                }
            }
        }

        if (is_callable($route['callback'])) {
            $route['callback']($request);
        } else if (is_string($route['callback'])) {
            ControllerProvider::startController($route['callback'], $request);
        }
    }
}