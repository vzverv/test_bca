<?php

declare(strict_types=1);

namespace App\Kernel;

final class Application
{
    public function run()
    {
        # error handler
        try {
            # routes
            require_once __DIR__ . '/../../src/config/routes.php';
        } catch (\Throwable $t) {
            # maybe I need a class that will build the message for exceptions

            echo $t->getMessage();
            echo 'Internal Server error';
        }
    }
}
