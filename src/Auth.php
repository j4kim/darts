<?php

namespace J4kim\Darts;

class Auth
{
    public static function login(string $username, string $password): bool
    {
        $exists = DB::one(
            "SELECT COUNT(*) FROM users WHERE username=? AND password=?",
            [$username, md5($password)]
        );
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

    public static function username(): string
    {
        return @$_SESSION['username'] ?? '';
    }
}