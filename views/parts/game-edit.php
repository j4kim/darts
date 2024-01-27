<div class="card bg-base-300 shadow-xl" hx-target="this" hx-swap="outerHTML">
    <div class="card-body">
        <h2 class="card-title">
            Partie <span class="opacity-50"><?= $game['id'] ?></span>
            du <span><?= (new DateTime($game['date']))->format("d.m.Y") ?></span>
        </h2>
        <div class="card-actions justify-end">
            <button class="btn btn-primary" hx-get="/game/<?=$game['id']?>" >
                Fermer
            </button>
        </div>
    </div>
</div>