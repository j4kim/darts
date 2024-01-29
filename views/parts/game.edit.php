<form
    class="card bg-base-200"
    hx-target="this"
    hx-swap="outerHTML"
    hx-post="/game/<?=$game->id?>"
>
    <div class="card-body gap-4">
        <h2 class="card-title">
            Partie <span class="opacity-50"><?= $game->id ?></span> du
            <input
                type="datetime-local"
                class="input"
                name="date"
                value="<?= $game->dateTime()->format("Y-m-d\TH:i") ?>"
            />
        </h2>
        <table class="table" x-data='{
            participants: <?= json_encode($game->tournamentParticipants) ?>,
            get nextRank() {
                return Math.max(...this.participants.map(p => p.rank)) + 1;
            },
        }'>
            <tbody>
                <template x-for="p in participants">
                    <tr>
                        <td>
                            <input
                                type="checkbox"
                                class="toggle toggle-primary"
                                :checked="!!p.rank"
                                @click="p.rank = p.rank ? null : nextRank"
                            />
                        </td>
                        <td x-text="p.username"></td>
                        <td>
                            <input
                                type="number"
                                class="input"
                                :name="`ranks[${p.user_id}]`"
                                x-model="p.rank"
                                min="1"
                                :max="participants.length"
                            />
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <p>
            <textarea
                class="textarea w-full"
                placeholder="Notes"
                name="notes"
            ><?= $game->notes ?></textarea>
        </p>
        <div class="card-actions items-center">
            <button
                class="btn btn-ghost text-error btn-circle"
                hx-delete="/game/<?= $game->id ?>"
                hx-confirm="Sûr ?"
                hx-indicator="next .htmx-indicator"
            >
                <!-- https://fontawesome.com/icons/trash -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512" fill="currentcolor">
                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                </svg>
            </button>
            <div class="flex-1"></div>
            <span class="htmx-indicator loading"></span>
            <button class="btn btn-ghost" hx-get="/game/<?= $game->id ?>" hx-indicator="previous .htmx-indicator">
                Annuler
            </button>
            <button class="btn btn-primary">
                Valider
            </button>
        </div>
    </div>
</form>