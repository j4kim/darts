<?php

use Bramus\Router\Router;
use J4kim\Darts\Auth;
use J4kim\Darts\Game;
use J4kim\Darts\Tournament;
use League\Plates\Engine;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new Router();
$templates = new Engine('../views');

$router->get('/', function () {
    $id = Tournament::getLastId();
    header("Location: /$id");
});

$router->get('/(\d+)', function ($id) use ($templates) {
    echo $templates->render('tournament', [
        'tournament' => new Tournament($id)
    ]);
});

$router->get('/login', function () use ($templates) {
    echo $templates->render('login');
});

$router->post('/login', function () {
    Auth::login(...$_POST);
    header('Location: /');
});

$router->get('/logout', function () {
    Auth::logout();
    header('Location: /');
});

// HTMX routes

$router->get('/game/(\d*)', function ($id) use ($templates) {
    echo $templates->render('parts/game', [
        'game' => Game::find($id),
    ]);
});

$router->get('/game/(\d*)/edit', function ($id) use ($templates) {
    echo $templates->render('parts/game.edit', [
        'game' => Game::find($id),
    ]);
});

$router->post('/game/(\d*)', function ($id) {
    Game::update($id, $_POST);
    header('Location: /game/' . $id);
});

$router->post('/game/new/(\d*)', function ($tournamentId) {
    Game::create($tournamentId);
    header('Location: /');
});

$router->run();
