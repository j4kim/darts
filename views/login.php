<?php $this->layout('layout'); ?>

<form
    class="flex flex-col gap-3 sm:w-60 mx-auto mt-8"
    method="POST"
    action="login"

>
    <p>
        <input
            class="input input-bordered w-full"
            name="username"
            placeholder="nom"
            autofocus
        >
    </p>
    <p>
        <input
            class="input input-bordered w-full"
            name="password"
            type="password"
            placeholder="mot de passe"
        >
    </p>
    <p>
        <button
            class="btn btn-primary w-full"
            type="submit"
        >
            Connexion
        </button>
    </p>
    <?php if(isset($error)) : ?>
        <div role="alert" class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span><?= $error ?></span>
        </div>
    <?php endif ?>
</form>