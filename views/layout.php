<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= file_exists('./output.css') ? './output.css' : './dist.css' ?>" rel="stylesheet">
    <link rel="icon" href="https://www.svgrepo.com/show/172641/darts.svg">
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/long-press-event/dist/long-press-event.min.js"></script>
    <title>Darts</title>
</head>
<body>
    <?php $this->insert('parts/header', ['menu' => $this->section('menu')]) ?>
    <main class="m-4">
        <?= $this->section('content') ?>
    </main>
</body>
</html>