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
                    'salutation' => 'Mr.',
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

        $clients = json_decode($result, true);

        $this->assertEquals(json_encode($clients['clients'][0]), json_encode($expected['clients'][0]));
    }

    /**
     * @test
     */
    public function delete_client()
    {
        $_REQUEST['id'] = 2;
        $this->apiCall('DELETE', '/api/v1/client');

        $responseCode = http_response_code();

        $this->assertEquals(204, $responseCode);
    }

    /**
     * @test
     */
    public function create_client()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Vasya',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'d@mail.ua',
            'country' => 'Canada (CAN)',
            'zip_code' => 'H4V 2V5',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $this->apiCall('POST', '/api/v1/client');

        $responseCode = http_response_code();

        $this->assertEquals(201, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_first_name_missing()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'d@mail.ua',
            'country' => 'Canada (CAN)',
            'zip_code' => 'H4V 2V5',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Missing required field "first_name" ', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_last_name_missing()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Vova',
            'email' => 'pupking22eg' . rand(50, 10000) .'d@mail.ua',
            'country' => 'Canada (CAN)',
            'zip_code' => 'H4V 2V5',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Missing required field "last_name" ', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_country_missing()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'d@mail.ua',
            'zip_code' => 'H4V 2V5',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Missing required field "country" ', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_success_comment_missing()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'d@mail.ua',
            'country' => 'Canada (CAN)',
            'zip_code' => 'H4V 2V5',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
        ];

        $this->apiCall('POST', '/api/v1/client');

        $responseCode = http_response_code();

        $this->assertEquals(201, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_success_zip_code_missing()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'d@mail.ua',
            'country' => 'Canada (CAN)',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
        ];

        $this->apiCall('POST', '/api/v1/client');

        $responseCode = http_response_code();

        $this->assertEquals(201, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_email_has_wrong_format()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'hdmail.ua',
            'zip_code' => 'H4V 2V5',
            'country' => 'Canada (CAN)',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Email has wrong format.', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_usa_zip_code()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'@hdmail.ua',
            'zip_code' => 'H4V 2V5',
            'country' => 'USA',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Zip Code must contain only digits for USA.', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_wrong_salutation()
    {
        $_REQUEST = [
            'salutation' => 'Mr',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'@hdmail.ua',
            'zip_code' => 'H4V 2V5',
            'country' => 'USA',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Salutation must be Mr., Ms., Mrs., Dr.', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_wrong_asset_class()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'@hdmail.ua',
            'zip_code' => 'H4V 2V5',
            'country' => 'USA',
            'asset_class' => 'Big',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('Asset class must be Large / Mid / Small', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_wrong_expected_purchase_date()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'@hdmail.ua',
            'zip_code' => '12365',
            'country' => 'USA',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2020-01-06', # Y-m-d
            'comments' => 'comments',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('The expected purchase date must be in future.', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }

    /**
     * @test
     */
    public function create_client_validation_fail_comment_too_long()
    {
        $_REQUEST = [
            'salutation' => 'Mr.',
            'first_name' => 'Dima',
            'last_name' => 'Pupkin',
            'email' => 'pupking22eg' . rand(50, 6000) .'@hdmail.ua',
            'zip_code' => '12365',
            'country' => 'USA',
            'asset_class' => 'Large',
            'investment_time' => 'Short',
            'expected_purchase_date' => '2030-01-06', # Y-m-d
            'comments' => 'comment comment comment comment comment commentcommentcomment comment comment comment
            commentcommentcommentcommentcommentcommentcommentcomment commentcommentcommentcommentcommentcomment
            commentcomment comment comment comment comment comment commentcommentcommentcommentcommentcomment
            commentcommentcommentcommentcommentcomment commentcommentcommentcommentcommentcomment commmmmmm mmmm
            dasfdsfkdjl commentcommentcommentcommentcommentcomment commentcommentcommentcommentcommentcomment dsfd 
            commentcommentcommentcommentcommentcomment commentcommentcommentcommentcommentcomment kjdsh kjsdk dskj sd
            commentcommentcommentcommentcommentcomment commentcommentcommentcommentcommentcomment adfdsfsdfsd',
        ];

        $response = $this->apiCall('POST', '/api/v1/client');

        $this->assertEquals('The comment can be max 500 symbols', $response);

        $responseCode = http_response_code();

        $this->assertEquals(400, $responseCode);
    }
}
