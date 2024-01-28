<?php $this->layout('layout') ?>

<h2 class="text-2xl my-4">Parties</h2>
<div class="flex flex-col gap-4">
    <?php if (J4kim\Darts\Auth::check()) include 'parts/game.new.php' ?>
    <?php foreach ($tournament->games as $game) include 'parts/game.php' ?>
</div>