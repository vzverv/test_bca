<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;
use App\Domain\Client\DTO\RetrieveClientsDTO;
use App\Infrastructure\ReadModel\SQLiteClientReadModel;

final class RetrieveClientsController extends ApiController
{
    public function __invoke()
    {
        $readModel = new SQLiteClientReadModel();

        $data = $readModel->retrieveAllClients();

        $dto = new RetrieveClientsDTO($data);

        $this->responseWithJson($dto->jsonSerialize(), 200);
    }
}
