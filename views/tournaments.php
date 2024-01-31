<?php $this->layout('layout') ?>

<h2 class="text-2xl my-4">Liste des tournois</h2>

<div class="flex flex-col gap-4" hx-boost="true">
    <?php foreach ($tournaments as $tournament) : ?>
        <a class="btn justify-start gap-0" href="/<?= $tournament->id ?>">
            <div class="text-left w-2/12 opacity-50"><?= $tournament->id ?></div>
            <div class="text-left w-10/12">
                <?= $tournament->games_count ?>
                partie<?= $tournament->games_count > 1 ? 's' : '' ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<?php $this->start('auth-menu') ?>
    <li>
        <form method="POST" action="/tournaments">
            <button>Nouveau tournoi</button>
        </form>
    </li>
<?php $this->stop() ?>