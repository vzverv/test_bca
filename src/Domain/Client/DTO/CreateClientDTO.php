<?php

declare(strict_types=1);

namespace App\Domain\Client\DTO;

use App\Exceptions\ValidationException;

final class CreateClientDTO implements \JsonSerializable
{
    /**
     * @var array
     */
    private $data;


    /**
     * CreateClientDTO constructor.
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        $this->data = $data;

        $this->validateRequiredFields();
        $this->validateData();
        #in DTO validate that e-mail is e-mail via input_filter()
    }

    private function validateRequiredFields()
    {
        $requiredFields = [
            'salutation',
            'first_name',
            'last_name',
            'email',
            'country',
            'asset_class',
            'investment_time',
            'expected_purchase_date',
        ];

        foreach ($requiredFields as $fieldName) {
            if (!isset($this->data[$fieldName])) {
                throw new ValidationException('Missing required field "' . $fieldName . '" ');
            }
        }
    }

    private function validateData()
    {
        if (filter_var($this->data['email'], FILTER_VALIDATE_EMAIL) === false)
        {
            throw new ValidationException('Email has wrong format.');
        }

        # validate date format

    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'salutation' => $this->data['salutation'],
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'email' => $this->data['email'],
            'country' => $this->data['country'],
            'zip_code' => $this->data['zip_code'] ?? '',
            'asset_class' => $this->data['asset_class'],
            'investment_time' => $this->data['investment_time'],
            'expected_purchase_date' => $this->data['expected_purchase_date'], # Y-m-d
            'comments' => $this->data['comments'] ?? '',
        ];
    }
}
