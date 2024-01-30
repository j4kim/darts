<?php

use J4kim\Darts\App;

require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config.php';

function config(string $key) {
    global $config;
    return $config[$key];
}

session_start();

new App();