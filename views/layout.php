<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <title>Darts</title>
</head>
<body>
    <main class="m-3">
        <div class="w-full sm:w-60">
            <?php $this->insert('parts/header') ?>
        </div>
        <?= $this->section('content') ?>
    </main>
</body>
</html>