<?php
require_once '../config/roots.php';
require_once '../core/Autoloader/Autoloader.php';
require_once 'helper.php';

Autoloader::register();

$paths = scandir(PATH_ROUTES);

foreach ($paths as $file) {
    $filePath = realpath(PATH_ROUTES . $file);
    if (is_file($filePath)) {
        require $filePath;
    }
}

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

Router::dispatch($uri, $method);
