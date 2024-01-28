<?php $this->layout('layout'); ?>

<h2 class="text-2xl my-4">Parties</h2>
<div class="flex flex-col gap-4">
    <?php if ($authenticated): ?>
        <form action="/newgame.php" method="POST">
            <input type="hidden" name="tournament_id" value="<?= $tournamentId ?>">
            <button class="btn btn-primary w-full" type="submit">
                +
            </button>
        </form>
    <?php endif; ?>
    <?php foreach ($games as $game) include 'parts/game.php' ?>
</div>