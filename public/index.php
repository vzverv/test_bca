<?php

# error handler
try {
    # autoloader
    require __DIR__ . '/../vendor/autoload.php';
    # routes
    require_once __DIR__ . '/../src/config/routes.php';
} catch (\Throwable $t) {
    # maybe I need a class that will build the message for exceptions

    echo $t->getMessage();
    echo 'Internal Server error';
}