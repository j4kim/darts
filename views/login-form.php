<form
    class="flex flex-col gap-3"
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
</form>