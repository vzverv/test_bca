<?php

declare(strict_types=1);

namespace App\Infrastructure\ReadModel;

use App\Domain\Client\ClientReadModelInterface;
use App\Infrastructure\SQLiteConnection;

final class SQLiteClientReadModel implements ClientReadModelInterface
{
    /**
     * @var SQLiteConnection
     */
    private $connection;

    public function __construct()
    {
        $this->connection = SQLiteConnection::getInstance();
    }
    public function retrieveAllClients(): array
    {
        $query = 'SELECT id, salutation, first_name, last_name, email, country, zip_code, 
                         asset_class, investment_time, expected_purchase_date, comments
                    FROM client';

        $statement = $this->connection->prepare($query);

        $res = $statement->execute();

        $result = [];

        while ($row = $res->fetchArray(SQLITE3_ASSOC))
        {
            $result[] = $row;
        }

        return is_array($result) ? $result : [];
    }

    public function retrieveActiveClients(): array
    {
        $query = 'SELECT id, salutation, first_name, last_name, email, country, zip_code, 
                         asset_class, investment_time, expected_purchase_date, comments
                    FROM client WHERE status = 1';

        $statement = $this->connection->prepare($query);

        $res = $statement->execute();

        $result = [];

        while ($row = $res->fetchArray(SQLITE3_ASSOC))
        {
            $result[] = $row;
        }

        return is_array($result) ? $result : [];
    }

    public function retrieveInactiveClients(): array
    {
        // TODO: Implement retrieveInactiveClients() method.
    }
}