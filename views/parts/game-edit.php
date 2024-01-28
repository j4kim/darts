<form
    class="card bg-base-200"
    hx-target="this"
    hx-swap="outerHTML"
    hx-post="/game/<?=$game['id']?>"
>
    <div class="card-body gap-4">
        <h2 class="card-title">
            Partie <span class="opacity-50"><?= $game['id'] ?></span> du
            <input
                type="datetime-local"
                class="input"
                name="date"
                value="<?= (new DateTime($game['date']))->format("Y-m-d\TH:i") ?>"
            />
        </h2>
        <p>
            <textarea
                class="textarea w-full"
                placeholder="Notes"
                name="notes"
            ><?= $game['notes'] ?></textarea>
        </p>
        <div class="card-actions justify-end items-center">
            <span class="htmx-indicator loading"></span>
            <button class="btn" hx-get="/game/<?=$game['id']?>" >
                Annuler
            </button>
            <button class="btn btn-primary">
                Valider
            </button>
        </div>
    </div>
</form>