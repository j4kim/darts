<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <title>Darts</title>
</head>
<body>
    <?php $this->insert('parts/header') ?>
    <main class="m-4">
        <?= $this->section('content') ?>
    </main>
</body>
</html>