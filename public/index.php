<?php

use Bramus\Router\Router;
use J4kim\Darts\Auth;
use League\Plates\Engine;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new Router();
$templates = new Engine('../views');

$router->get('/', function () use ($templates) {
    echo $templates->render('games');
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
