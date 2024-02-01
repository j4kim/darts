<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= file_exists('./output.css') ? './output.css' : './dist.css' ?>" rel="stylesheet">
    <link rel="icon" href="https://www.svgrepo.com/show/172641/darts.svg">
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/long-press-event/dist/long-press-event.min.js"></script>
    <title>Ptite fléchette ?</title>
</head>
<body>
    <header class="navbar bg-base-200 p-4">
        <div>
            <a class="text-2xl font-bold" href="/">Ptite fléchette ?</a>
        </div>
        <div class="flex-1"></div>
        <div class="dropdown dropdown-end">
            <div class="btn btn-circle btn-ghost" tabindex="0" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" fill="currentcolor">
                    <path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z" />
                </svg>
            </div>
            <ul 
                hx-boost="true"
                class="mt-2 p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52"
                tabindex="0"
            >
                <?php if (J4kim\Darts\Auth::check()) : ?>
                    <li class="px-4 py-2 opacity-50"><?= J4kim\Darts\Auth::username() ?></li>
                    <li><a href="logout">Se déconnecter</a></li>
                    <li></li>
                    <?= $this->section('auth-menu') ?>
                <?php else : ?>
                    <li><a href="login">Se connecter</a></li>
                <?php endif; ?>
                <li><a href="counter">Compteur</a></li>
                <?= $this->section('menu') ?>
            </ul>
        </div>
    </header>
    <main class="m-4">
        <?= $this->section('content') ?>
    </main>
</body>
</html>