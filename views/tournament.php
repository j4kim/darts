<?php $this->layout('layout') ?>

<h2 class="text-2xl my-4">Parties</h2>
<div class="flex flex-col gap-4">
    <?php if (J4kim\Darts\Auth::check()): ?>
        <form action="/newgame.php" method="POST">
            <input type="hidden" name="tournament_id" value="<?= $tournament->id ?>">
            <button class="btn btn-primary w-full text-xl" type="submit">
                +
            </button>
        </form>
    <?php endif; ?>
    <?php foreach ($tournament->games as $game) include 'parts/game.php' ?>
</div>