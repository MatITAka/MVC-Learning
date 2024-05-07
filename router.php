<?php

class Router {
    private $routes = [];

    public function addRoute($route, $controller, $method) {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($route) {
        if (array_key_exists($route, $this->routes)) {
            $controller = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            $controllerInstance = new $controller;
            $controllerInstance->$method();
        } else {
            echo "404 Not Found";
        }
    }
}

?>