<?php

use App\Controllers\AppController;
use App\Controllers\Client\CreateClientController;
use App\Controllers\Client\RetrieveClientsController;
use App\Utilities\Router;

$router = new Router();

$router->get('/', new AppController());
$router->get('/api/v1/clients', new RetrieveClientsController());

$router->post('/api/v1/client', new CreateClientController());

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

}
