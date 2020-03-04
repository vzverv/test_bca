<?php
declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;

final class CreateClientController extends ApiController
{
    public function __invoke()
    {
        $response = [];
        $this->responseWithJson($response);
    }
}
