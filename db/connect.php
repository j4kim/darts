<?php

$config = require_once __DIR__ . '/../config.php';

$host = $config['DB_HOST'];
$db = $config['DB_NAME'];
$user = $config['DB_USER'];
$pwd = $config['DB_PWD'];

return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);