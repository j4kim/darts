<?php

use Bramus\Router\Router;
use J4kim\Darts\Auth;
use J4kim\Darts\DB;
use League\Plates\Engine;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new Router();
$templates = new Engine('../views');

$router->get('/(\d*)', function ($id) use ($templates) {
    if (!$id) {
        $id = DB::one("SELECT id FROM tournaments ORDER BY id DESC LIMIT 1");
    }

    $games = DB::all("SELECT * FROM games WHERE tournament_id=$id ORDER BY id DESC");

    echo $templates->render('tournament', [
        'games' => $games,
        'authenticated' => Auth::check(),
    ]);
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
