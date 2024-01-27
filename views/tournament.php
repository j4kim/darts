<?php $this->layout('layout'); ?>

<h2 class="text-2xl my-4">Parties</h2>
<div class="flex flex-col gap-2">
    <?php if ($authenticated): ?>
        <form action="/newgame.php" method="POST">
            <input type="hidden" name="tournament_id" value="<?= $tournamentId ?>">
            <button class="btn btn-primary w-full" type="submit">
                +
            </button>
        </form>
    <?php endif; ?>
    <?php foreach ($games as $game): ?>
        <a class="btn justify-start" href="/game.php?game=<?= $game['id'] ?>">
            <div class="w-8 opacity-50">
                <?= $game['id'] ?>
            </div>
            <?= (new DateTime($game['date']))->format("d.m.Y") ?>
        </a>
    <?php endforeach; ?>
</div>