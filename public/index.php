<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$router = new \Bramus\Router\Router();

$router->get('/', function () {
    require '../views/home.php';
});

$router->run();
