<?php

namespace J4kim\Darts;

class Auth
{
    public static function login(string $username, string $password): bool
    {
        $hash = md5($password);
        $pdo = DB::connect();
        $query = "SELECT COUNT(*) FROM users WHERE username=? AND password=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $hash]);
        $exists = $stmt->fetchColumn();
        if ($exists) {
            $_SESSION['username'] = $username;
        }
        return $exists === 1;
    }

    public static function logout(): bool
    {
        return session_destroy();
    }

    public static function check(): bool
    {
        return isset($_SESSION['username']);
    }
}