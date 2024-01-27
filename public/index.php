<?php

use J4kim\Darts\Auth;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new \Bramus\Router\Router();

$router->get('/', function () {
    require '../views/home.php';
});

$router->post('login', function () {
    Auth::login(...$_POST);
    header('Location: /');
});

$router->post('logout', function () {
    Auth::logout();
    header('Location: /');
});

$router->run();
