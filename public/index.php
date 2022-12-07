<?php

use App\Router;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Router.php';


session_start();

try {
    Router::route();
}
catch (ReflectionException $e) {
    echo "Une erreur est survenu avec le rooter";
}