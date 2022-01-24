<?php

function __(string $path) : mixed {
        $locale = bootstrap\services\Locale::currentLocale();

        $parts = explode('@', $path);

        $parsedPath = str_replace('.', '/', $parts[0]);
        $name = $parts[1];
        
        $response = include '../resources/lang/' . $locale . '/'. $parsedPath . '.php';

        if(empty($response))
            return $locale.'/'.$parsedPath.'.php not found.';

        if(empty($response[$name]))
            return $path.' not found.';

        return $response[$name];
    }