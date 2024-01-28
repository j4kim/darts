<header class="navbar bg-base-200 p-4">
    <div>
        <a class="text-2xl font-bold" href="/">Ptite fléchette ?</a>
    </div>
    <div class="flex-1"></div>
    <div>
        <ul class="menu menu-horizontal px-1">
            <li hx-boost="true">
                <?php if (J4kim\Darts\Auth::check()): ?>
                    <a href="logout">Se déconnecter</a>
                <?php else: ?>
                    <a href="login">Se connecter</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</header>