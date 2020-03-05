<?php

use App\Kernel\Application;
# autoloader
require __DIR__ . '/../vendor/autoload.php';
$app = new Application();

$app->run();
