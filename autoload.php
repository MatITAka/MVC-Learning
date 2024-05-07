<?php

spl_autoload_register(function ($class_name) {
    $controllerFile = __DIR__ . '/controllers/' . $class_name . '.php';
    $srcFile = __DIR__ . '/src/' . $class_name . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    }
});

?>