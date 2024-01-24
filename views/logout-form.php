<p class="mb-3">Bonjour <?= $_SESSION['username'] ?></p>
<form method="POST" action="logout.php">
    <button class="btn w-full" type="submit">Déconnexion</button>
</form>