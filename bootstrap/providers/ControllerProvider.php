<?php

namespace Bootstrap\Providers;

use bootstrap\models\Controller;
use bootstrap\models\Request;

class ControllerProvider {
	
    public static function startController(string $path, Request $request) {
        require_once "..\bootstrap\models\Controller.php";

        $executeParts = explode('@', $path);
        $parts = explode('.', $executeParts[0]);

        $filePath = str_replace('.', '/', $executeParts[0]);
        
        $class = $parts[sizeof($parts) -1];
        $function = $executeParts[1];
        
        require_once '../app/Controllers/'.$filePath.'.php';
        
        $instance = new $class;
        if($instance instanceof Controller)
            $instance->{$function}($request);
    }
}