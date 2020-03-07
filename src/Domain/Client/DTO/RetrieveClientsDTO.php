<?php

declare(strict_types=1);

namespace App\Domain\Client\DTO;

final class RetrieveClientsDTO implements \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * RetrieveClientsDTO constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $clients = [];

        foreach ($this->data as $client)
        {
            $clients[] = [
                'id' => $client['id'] ?? 0,
                'salutation' => $client['salutation'] ?? '',
                'first_name' => $client['first_name'] ?? '',
                'last_name' => $client['last_name'] ?? '',
                'email' => $client['email'] ?? '',
                'country' => $client['country'] ?? '',
                'zip_code' => $client['zip_code'] ?? '',
                'asset_class' => $client['asset_class'] ?? '',
                'investment_time' => $client['investment_time'] ?? '',
                'expected_purchase_date' => $client['expected_purchase_date'] ?? '', # Y-m-d
                'comments' => $client['comments'] ?? ''
            ];
        }

        return [
            'clients' => $clients
        ];
    }
}
