<?php

declare(strict_types=1);

namespace App\Infrastructure;

use \SQLite3;

final class SQLiteConnection extends SQLite3
{
    private static $instance;

    private function __construct()
    {
        parent::__construct(dirname(__DIR__, 2) . '/database/bca.sqlite');
    }

    private function __clone()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }
}
