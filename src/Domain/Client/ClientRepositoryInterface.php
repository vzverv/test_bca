<?php

declare(strict_types=1);

namespace App\Domain\Client;
/**
 * Interface ClientRepositoryInterface
 *
 * This is a contract for repository.
 *
 * @package App\Domain\Client
 */
interface ClientRepositoryInterface
{
    public function createClient(array $data): bool;
    public function deleteClient(int $id): bool;
    public function emailRegistered(string $email): bool;
}
