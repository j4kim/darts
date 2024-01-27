<?php

namespace J4kim\Darts;

class DB {
    private static $pdoInstance;

    public static function connect(): \PDO
    {
        $config = require_once __DIR__ . '/../config.php';

        $host = $config['DB_HOST'];
        $db = $config['DB_NAME'];
        $user = $config['DB_USER'];
        $pwd = $config['DB_PWD'];

        return new \PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    }

    public static function pdo(): \PDO
    {
        if (self::$pdoInstance === null) {
            self::$pdoInstance = self::connect();
        }
        return self::$pdoInstance;
    }
}