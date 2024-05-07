<?php

require_once 'autoload.php';
require_once 'router.php';

$router = new Router();

$router->addRoute('/', 'HomeController', 'index');
$router->addRoute('/edit', 'HomeController','edit');
$router->addRoute('/data', 'DataController', 'index');
$router->addRoute('/contact', 'ContactController', 'index');
$router->addRoute('/about', 'AboutController', 'index');
$router->addRoute('/login', 'LoginController','login');
$router->addRoute('/logout', 'LoginController','logout');
$router->addRoute('/upload', 'GalerieController','upload');
$router->addRoute('/galerie', 'GalerieController','galerie');
$router->addRoute('/delete', 'GalerieController','delete');
$router->addRoute('/like', 'GalerieController','like');
$router->addRoute('/comment', 'GalerieController','comment');
$router->addRoute('/delete_comment', 'GalerieController','delete_comment');


$route = $_SERVER['REQUEST_URI'];
$router->dispatch($route);

?>


