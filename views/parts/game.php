<a
    class="btn justify-start"
    hx-get="/game/<?= $game->id ?>/edit"
    hx-swap="outerHTML"
>
    <div class="w-8 opacity-50">
        <?= $game->id ?>
    </div>
    <div class="w-24">
        <?= $game->formattedDate() ?>
    </div>
    <div class="font-normal">
        <?= $game->winner ?>
    </div>
</a>