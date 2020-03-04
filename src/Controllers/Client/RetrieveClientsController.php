<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;

final class RetrieveClientsController extends ApiController
{
    public function __invoke()
    {
        $response = ['message' => 'clients'];
        $this->responseWithJson($response);
    }
}
