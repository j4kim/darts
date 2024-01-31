<?php $this->layout('layout') ?>

<h2 class="text-2xl my-4">Liste des tournois</h2>

<?php foreach ($tournaments as $tournament) : ?>
    <div class="flex flex-col gap-4" hx-boost="true">
        <a class="btn justify-start" href="/<?= $tournament->id ?>">
            <?= $tournament->id ?>
        </a>
    </div>
<?php endforeach; ?>