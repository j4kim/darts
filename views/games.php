<?php
$pdo = require_once __DIR__ . '/../db/connect.php';

$tournamentId = @$_GET['tournament'];

$stmt = $pdo->prepare("SELECT * FROM games WHERE tournament_id=?");
$stmt->execute([$tournamentId]);
$games = $stmt->fetchAll();
?>

<h2 class="text-2xl my-4">Parties</h2>
<div class="flex flex-col gap-2">
    <button class="btn btn-primary" type="submit">
        +
    </button>
    <?php foreach ($games as $game): ?>
        <a class="btn justify-start" href="/game?game=<?= $game['id'] ?>">
            <div class="w-8 opacity-50">
                <?= $game['id'] ?>
            </div>
            <?= $game['date'] ?>
        </a>
    <?php endforeach; ?>
</div>