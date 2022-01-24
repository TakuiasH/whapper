<?php
    function view(string $path, array $viewArguments = []){        
        $blade = new eftec\bladeone\BladeOne('../resources/views');        
        echo $blade->run($path, $viewArguments);
    }