<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase;

final class DeleteClient
{
    public function handle(int $id)
    {
        # do not delete the record, just change the status
    }
}
