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

        $this->router->delete('/(\d+)', function ($id) {
            Tournament::delete($id);
            header('Location: /tournaments', true, 303);
        });

        $this->router->post('/(\d+)/add-participant', function ($id) {
            $username = $_SERVER['HTTP_HX_PROMPT'];
            Tournament::addParticipant($id, $username);
            header("Location: /$id");
        });

        $this->router->delete('/(\d+)/remove-participant/(\d+)', function (int $id, int $userId) {
            Tournament::removeParticipant($id, $userId);
        });

        $this->router->get('/tournaments', function () {
            echo $this->templates->render('tournaments', [
                'tournaments' => Tournament::all(),
            ]);
        });

        $this->router->post('/tournaments', function () {
            Tournament::create();
            header('Location: /tournaments');
        });

        $this->router->get('/login', function () {
            echo $this->templates->render('login');
        });

        $this->router->post('/login', function () {
            if (Auth::login(...$_POST)) {
                header('Location: /');
                return;
            }
            header('Location: /login?message=Non');
        });

        $this->router->get('/logout', function () {
            Auth::logout();
            header('Location: /');
        });

        // HTMX routes

        $this->router->get('/game/(\d+)', function ($id) {
            $this->echoGameItem($id);
        });

        $this->router->get('/game/(\d+)/edit', function ($id) {
            $this->echoGameEditForm($id);
        });

        $this->router->post('/game/(\d+)', function ($id) {
            Game::update($id, $_POST);
            $this->echoGameItem($id);
        });

        $this->router->post('/game/new/(\d+)', function ($tournamentId) {
            $id = Game::create($tournamentId);
            $this->echoGameEditForm($id);
        });

        $this->router->delete('/game/(\d+)', function ($id) {
            Game::delete($id);
            echo "<div>Partie $id supprimée</div>";
        });

        // Webhook

        $this->router->post('/webhook', function () {
            $hookId = getallheaders()['X-Github-Hook-Id'];
            $payload = json_decode($_POST['payload']);
            if ($hookId == config('GITHUB_HOOK_ID') && $payload->ref == config('GITHUB_HOOK_REF')) {
                echo shell_exec("cd .. && git pull 2>&1");
            }
        });
    }

    public function echoGameItem(int $gameId)
    {
        echo $this->templates->render('parts/game', [
            'game' => Game::find($gameId),
        ]);
    }

    public function echoGameEditForm(int $gameId)
    {
        $game = Game::find($gameId);
        $game->loadParticipants();
        echo $this->templates->render('parts/game.edit', [
            'game' => $game,
        ]);
    }
}
