<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;
use App\Domain\Client\UseCase\DeleteClient;

final class DeleteClientController extends ApiController
{
    public function __invoke()
    {
        $id = $_REQUEST['id'] ?? '';

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $deleteClient = new DeleteClient();

        $deleteClient->handle($id);

        $this->responseNoContent();
    }
}
