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
        $body = file_get_contents('php://input');

        $inputData = json_decode($body, true);

        $inputData = $inputData ?? $_REQUEST;

        $dto = new CreateClientDTO($inputData ?? []);

        $createClient = new CreateClient();

        $createClient->handle($dto->jsonSerialize());
        $response = [];
        $this->responseWithJson($response, 201);
    }
}
