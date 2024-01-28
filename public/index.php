<?php

use Bramus\Router\Router;
use J4kim\Darts\Auth;
use J4kim\Darts\DB;
use J4kim\Darts\Game;
use League\Plates\Engine;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new Router();
$templates = new Engine('../views');

$router->get('/(\d*)', function ($id) use ($templates) {
    if (!$id) {
        $id = DB::one("SELECT id FROM tournaments ORDER BY id DESC LIMIT 1");
    }

    $games = DB::all("SELECT * FROM games WHERE tournament_id=$id ORDER BY date DESC");

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

// HTMX routes

$router->get('game/(\d*)', function ($id) use ($templates) {
    echo $templates->render('parts/game', [
        'game' => Game::find($id),
    ]);
});

$router->get('game/(\d*)/edit', function ($id) use ($templates) {
    echo $templates->render('parts/game-edit', [
        'game' => Game::find($id),
    ]);
});

$router->post('game/(\d*)', function ($id) use ($templates) {
    foreach($_POST as $key => $value) {
        if (str_starts_with($key, '_')) continue;
        Game::update($id, $key, $value);
    }
    header('Location: /game/' . $id);
});

$router->run();
