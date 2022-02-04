<?php
    require '../vendor/autoload.php';
    
    spl_autoload_register(function ($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $filename =  '..' . DIRECTORY_SEPARATOR . $className . '.php';
        if (is_readable($filename)) require_once($filename);
    });

    new bootstrap\Kernel();