<?php $this->layout('layout') ?>

<h2 class="text-2xl my-4">Liste des tournois</h2>

<div class="flex flex-col gap-4" hx-boost="true">
    <?php foreach ($tournaments as $tournament) : ?>
        <a class="btn justify-start" href="/<?= $tournament->id ?>">
            <?= $tournament->id ?>
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