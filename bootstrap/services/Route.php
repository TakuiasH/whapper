<?php namespace bootstrap\services;

class Route
{
    
    public static $routes = [
        'GET' => [],
        'POST' => [],
        'ANY' => []
    ];
    
    private static function addRoute(string $method, string $path, mixed $callback, array $middleware = []) {
        self::$routes[$method] = array_merge(self::$routes[$method], [$path => ['middleware' => $middleware, 'callback' => $callback]]);
    }
    
    public static function redirect($path) {
        $url = app['url'];
        if(!str_ends_with($url, "/")) $url = $url."/";
        
        if(str_starts_with($path, "/")) $path = substr($path, 1);

        header('Location: ' . $url . $path);
    }
    
    public static function get404(mixed $callback, array $middleware = []) {
        self::addRoute('GET', 'error_404', $callback, $middleware);
    }
    
    public static function post404(mixed $callback, array $middleware = []) {
        self::addRoute('POST', 'error_404', $callback, $middleware);
    }
    
    public static function any404(mixed $callback, array $middleware = []) {
        self::addRoute('ANY', 'error_404', $callback, $middleware);
    }

    public static function get(string $path, mixed $callback, array $middleware = []) {
        self::addRoute('GET', $path, $callback, $middleware);
    }
    
    public static function post(string $path, mixed $callback, array $middleware = []) {
        self::addRoute('POST', $path, $callback, $middleware);
    }
    
    public static function any(string $path, mixed $callback, array $middleware = []) {
        self::addRoute('ANY', $path, $callback, $middleware);
    }
    
    public static function currentPath() : string {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        
        $parts = array_diff_assoc($request_uri, $script_name);
        
	    if (empty($parts)) return '';
        
        $path = implode('/', $parts);
        
        if (($position = strpos($path, '?')) !== FALSE) $path = substr($path, 0, $position);
        
        return strtolower($path);
    }
    
}