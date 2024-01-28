<?php

namespace J4kim\Darts;

use PDO;

class DB
{
    private static $pdoInstance;

    public static function connect(): PDO
    {
        $config = require_once __DIR__ . '/../config.php';

        $host = $config['DB_HOST'];
        $db = $config['DB_NAME'];
        $user = $config['DB_USER'];
        $pwd = $config['DB_PWD'];

        return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    }

    public static function pdo(): PDO
    {
        if (self::$pdoInstance === null) {
            self::$pdoInstance = self::connect();
        }
        return self::$pdoInstance;
    }

    public static function fetch(string $query, array $params = [], string $method = 'fetch')
    {
        $stmt = self::pdo()->prepare($query);
        $stmt->execute($params);
        return $stmt->$method();
    }

    public static function all(string $query, array $params = []): array
    {
        return self::fetch($query, $params, 'fetchAll');
    }

    public static function one(string $query, array $params = [])
    {
        return self::fetch($query, $params, 'fetchColumn');
    }
}