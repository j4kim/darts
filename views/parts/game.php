<a
    class="btn justify-start"
    hx-get="/game/<?= $game->id ?>/edit"
    hx-swap="outerHTML"
>
    <div class="w-8 opacity-50">
        <?= $game->id ?>
    </div>
    <?= $game->formattedDate() ?>
    <span class="htmx-indicator loading"></span>
</a>