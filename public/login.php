<?php
$username = @$_POST['username'];
$password = @$_POST['password'];

if ($username && $password) {
    $hash = md5($password);
    /** @var PDO $pdo */
    $pdo = require_once __DIR__ . '/../db/connect.php';
    $query = "SELECT COUNT(*) FROM users WHERE username=? AND password=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $hash]);
    $exists = $stmt->fetchColumn();
    if ($exists) {
        session_start();
        $_SESSION['username'] = $username;
    }
}

header('Location: /');
?>