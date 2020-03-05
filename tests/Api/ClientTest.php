<?php

declare(strict_types=1);

namespace Tests\Api;

use App\Kernel\Application;

final class ClientTest extends BaseApiTestCase
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @test
     */
    public function retrieve_all_clients_success()
    {
        $result = $this->get('/api/v1/clients');

        $responseCode = http_response_code();

        $this->assertEquals(200, $responseCode);
        $this->assertJson($result);

        $expected = [
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

        $this->assertJsonStringEqualsJsonString($result, json_encode($expected));
    }

    /**
     * @test
     */
    public function delete_client()
    {
        $this->apiCall('DELETE', '/api/v1/client/1');

        $responseCode = http_response_code();
        $this->assertEquals(204, $responseCode);
    }

    /**
     * @test
     */
    public function create_client()
    {
        $this->apiCall('POST', '/api/v1/client/1');

        $responseCode = http_response_code();
        $this->assertEquals(201, $responseCode);
    }
}
