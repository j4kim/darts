<header class="navbar bg-base-200 p-4">
    <div>
        <a class="text-2xl font-bold" href="/">Ptite fléchette ?</a>
    </div>
    <div class="flex-1"></div>
    <div class="dropdown dropdown-end">
        <div class="btn btn-circle btn-ghost" tabindex="0" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24">
                <path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z" />
            </svg>
        </div>
        <ul class="mt-2 p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
            <li hx-boost="true">
                <?php if (J4kim\Darts\Auth::check()) : ?>
                    <a href="logout">Se déconnecter</a>
                <?php else : ?>
                    <a href="login">Se connecter</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</header>