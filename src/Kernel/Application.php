<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Exceptions\ValidationException;

final class Application
{
    public function run()
    {
        # error handler
        try {
            # routes
            require_once __DIR__ . '/../../src/config/routes.php';
        } catch (ValidationException $v) {

            http_response_code(400);

            echo $v->getMessage();
        } catch (\InvalidArgumentException $v) {

            http_response_code(400);

            echo $v->getMessage();
        } catch (\Throwable $t) {
            # maybe I need a class that will build the message for exceptions

            echo $t->getMessage();
            echo 'Internal Server error';
        }
    }
}
