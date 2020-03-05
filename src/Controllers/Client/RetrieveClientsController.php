<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use App\Controllers\ApiController;

final class RetrieveClientsController extends ApiController
{
    public function __invoke()
    {
        $response = [
            'clients' => [
                [
                    'id' => 1,
                    'salutation' => 'Mr',
                    'first_name' => 'Vasya',
                    'last_name' => 'Pupkin',
                    'email' => 'pupkin@mail.ua',
                    'country' => 'Canada (CAN)',
                    'zip_code' => 'H4V 2V5',
                    'asset_class' => 'Large',
                    'investment_time' => 'Short',
                    'expected_purchase_date' => '2030-01-06' # Y-m-d
                ]
            ]
        ];

        $this->responseWithJson($response, 200);
    }
}
