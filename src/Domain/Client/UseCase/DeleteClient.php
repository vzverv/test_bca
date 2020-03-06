<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase;

use App\Infrastructure\Repository\SQLiteClientRepository;

final class DeleteClient
{
    final public function handle(int $id)
    {
        $repository = new SQLiteClientRepository();

        $result = $repository->deleteClient($id);

        if ($result !== true)
        {
            throw new \Exception('Client deletion failed.');
        }
    }
}
