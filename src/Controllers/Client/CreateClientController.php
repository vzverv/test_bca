<?php
declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;
use App\Domain\Client\DTO\CreateClientDTO;
use App\Domain\Client\UseCase\CreateClient;

final class CreateClientController extends ApiController
{
    /**
     * @throws \Exception
     */
    public function __invoke()
    {
        $dto = new CreateClientDTO($_REQUEST);

        $createClient = new CreateClient();

        $createClient->handle($dto->jsonSerialize());
        $response = [];
        $this->responseWithJson($response, 201);
    }
}
