<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Client\ClientRepositoryInterface;
use App\Infrastructure\SQLiteConnection;

final class SQLiteClientRepository implements ClientRepositoryInterface
{
    /**
     * @var SQLiteConnection
     */
    private $connection;

    public function __construct()
    {
        $this->connection = SQLiteConnection::getInstance();
    }

    public function createClient(array $data): int
    {
        $query = "INSERT INTO client                    
                   (salutation, first_name, last_name,email, country, zip_code, asset_class, investment_time, expected_purchase_date, comments)                   
                   VALUES
                   (:salutation, :first_name, :last_name, :email, :country, :zip_code, :asset_class, :investment_time, :expected_purchase_date, :comments)                    
                   ";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':salutation', $data['salutation']);
        $statement->bindValue(':first_name', $data['first_name']);
        $statement->bindValue(':last_name', $data['last_name']);
        $statement->bindValue(':email', $data['email']);
        $statement->bindValue(':country', $data['country']);
        $statement->bindValue(':zip_code', $data['zip_code']);
        $statement->bindValue(':asset_class', $data['asset_class']);
        $statement->bindValue(':investment_time', $data['investment_time']);
        $statement->bindValue(':expected_purchase_date', $data['expected_purchase_date']);
        $statement->bindValue(':comments', $data['comments']);

        $statement->execute();

        $id = $this->connection->lastInsertRowID();

        return $id ?? 0;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteClient(int $id): bool
    {
        $query = 'DELETE FROM client WHERE id = :id';

        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id);
        $result = $statement->execute();

        return (bool)$result;
    }

    public function emailRegistered(string $email): bool
    {
        $query = 'SELECT COUNT(id) FROM client WHERE email LIKE :email';

        $statement = $this->connection->prepare($query);

        $statement->bindValue(':email', $email);
        $result = $statement->execute();

        $result = $result->fetchArray();

        return $result[0] ? $result[0] > 0 : false;
    }
}
