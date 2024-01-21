<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darts</title>
</head>
<body>
    <?php if (isset($_SESSION['username'])): ?>
        <p>Bonjour <?= $_SESSION['username'] ?></p>
        <form method="POST" action="logout.php">
            <button type="submit">Déconnexion</button>
        </form>
    <?php else: ?>
        <form method="POST" action="login.php">
            <p>
                <input name="username" placeholder="nom" autofocus>
            </p>
            <p>
                <input name="password" type="password" placeholder="mot de passe">
            </p>
            <p>
                <button type="submit">Connexion</button>
            </p>
        </form>
    <?php endif; ?>
</body>
</html>