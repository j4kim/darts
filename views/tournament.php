<?php $this->layout('layout') ?>

<h2 class="text-2xl my-4">Classement</h2>
<?php include 'parts/ranking.php' ?>

<h2 class="text-2xl my-4">Parties</h2>
<div class="flex flex-col gap-4">
    <?php if (J4kim\Darts\Auth::check()) include 'parts/game.new.php' ?>
    <?php foreach ($tournament->games as $game) include 'parts/game.php' ?>
</div>

<?php $this->start('auth-menu') ?>
    <li hx-prompt="Nom du joueur">
        <form method="POST" action="/<?= $tournament->id ?>/add-participant">
            <button>Ajouter un joueur</button>
        </form>
    </li>
    <?php if (count($tournament->games) == 0): ?>
        <li>
            <form method="DELETE" action="/<?= $tournament->id ?>">
                <button>Supprimer le tournoi</button>
            </form>
        </li>
    <?php endif ?>
<?php $this->stop() ?>

<?php $this->start('menu') ?>
    <li><a href="/tournaments">Liste des tournois</a></li>
<?php $this->stop() ?>