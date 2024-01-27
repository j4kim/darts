<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Darts</title>
</head>
<body>
    <main class="m-3">
        <div class="w-full sm:w-60">
            <?php include("../views/header.php") ?>
        </div>
        <?php include("../views/games.php") ?>
    </main>
</body>
</html>