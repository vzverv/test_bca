<?php

declare(strict_types=1);

namespace App\Domain\Client;

interface ClientReadModelInterface
{
    public function retrieveAllClients(): array;
    public function retrieveActiveClients(): array;
    public function retrieveInactiveClients(): array;
}
