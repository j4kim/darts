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
    $game = DB::fetch("SELECT * FROM games WHERE id=$id");
    echo $templates->render('parts/game', [
        'game' => $game,
    ]);
});

$router->get('game/(\d*)/edit', function ($id) use ($templates) {
    $game = DB::fetch("SELECT * FROM games WHERE id=$id");
    echo $templates->render('parts/game-edit', [
        'game' => $game,
    ]);
});

$router->post('game/(\d*)', function ($id) use ($templates) {
    if ($_POST['date']) {
        $stmt = DB::pdo()->prepare("UPDATE games SET date=? WHERE id=?");
        $stmt->execute([$_POST['date'], $id]);
    }
    header('Location: /game/' . $id);
});

$router->run();
