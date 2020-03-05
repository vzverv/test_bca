<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;

final class DeleteClientController extends ApiController
{
    public function __invoke()
    {
        $response = [];
        $this->responseWithJson($response, 204);
    }
}