<a class="btn justify-start" href="/game.php?game=<?= $game['id'] ?>">
    <div class="w-8 opacity-50">
        <?= $game['id'] ?>
    </div>
    <?= (new DateTime($game['date']))->format("d.m.Y") ?>
</a>