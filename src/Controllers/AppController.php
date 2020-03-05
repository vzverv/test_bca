<?php

declare(strict_types = 1);

namespace App\Controllers;

final class AppController
{
    public function __invoke()
    {

        header('Content-Type: text/html');

        return require_once __DIR__ . '/../../public/views/app.html';
    }
}
