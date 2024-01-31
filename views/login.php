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
    <?php if(@$_GET['message']) : ?>
        <p class="text-red-500"><?= $_GET['message'] ?></p>
    <?php endif ?>
</form>