<?php

namespace J4kim\Darts;

use Bramus\Router\Router;
use League\Plates\Engine;

class App
{
    private Router $router;
    private Engine $templates;

    public function __construct()
    {
        $this->router = new Router();
        $this->templates = new Engine('../views');;
        $this->registerRoutes();
        $this->router->run();
    }

    private function registerRoutes()
    {
        $this->router->get('/', function () {
            $id = Tournament::getLastId();
            header("Location: /$id");
        });

        $this->router->get('/(\d+)', function ($id) {
            echo $this->templates->render('tournament', [
                'tournament' => new Tournament($id)
            ]);
        });

        $this->router->get('/login', function () {
            echo $this->templates->render('login');
        });

        $this->router->post('/login', function () {
            Auth::login(...$_POST);
            header('Location: /');
        });

        $this->router->get('/logout', function () {
            Auth::logout();
            header('Location: /');
        });

        // HTMX routes

        $this->router->get('/game/(\d+)', function ($id) {
            echo $this->templates->render('parts/game', [
                'game' => Game::find($id),
            ]);
        });

        $this->router->get('/game/(\d+)/edit', function ($id) {
            $this->echoGameEditForm($id);
        });

        $this->router->post('/game/(\d+)', function ($id) {
            Game::update($id, $_POST);
            header('Location: /game/' . $id);
        });

        $this->router->post('/game/new/(\d+)', function ($tournamentId) {
            $id = Game::create($tournamentId);
            $this->echoGameEditForm($id);
        });

        $this->router->delete('/game/(\d+)', function ($id) {
            Game::delete($id);
            echo "<div>Partie $id supprimée</div>";
        });
    }

    public function echoGameEditForm(int $gameId)
    {
        $game = Game::find($gameId);
        $participants = Tournament::getParticipants($game->tournament_id);
        echo $this->templates->render('parts/game.edit', [
            'game' => $game,
            'participants' => $participants,
        ]);
    }
}
