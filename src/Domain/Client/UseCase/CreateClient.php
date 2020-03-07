<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase;

use App\Infrastructure\Repository\SQLiteClientRepository;

final class CreateClient
{
    /**
     * @param array $data
     * @return int
     * @throws \Exception
     */
    final public function handle(array $data): int
    {
        $repository = new SQLiteClientRepository();

        $emailRegistered = $repository->emailRegistered($data['email']);

        if ($emailRegistered === true) {
            throw new \InvalidArgumentException('Email already exists.');
        }

        $data['country'] = $this->resolveCountry($data['country']);

        # validate allowed values for salutation etc
        $this->checkBusinessRules($data);

        $id = $repository->createClient($data);

        # we should always have an id greater than 0
        if ((int)$id <= 0) {
            throw new \LogicException('Client creation failed.');
        }

        return $id;
    }

    /**
     * Business rules could be done within Client entity, but it will require to create hydrator and will add complexity
     * @param array $data
     * @throws \Exception
     */
    private function checkBusinessRules(array $data)
    {
        $this->salutation($data['salutation']);
        $this->assetClass($data['asset_class']);
        $this->usaZipCode($data['country'], $data['zip_code']);
        $this->expectedPurchaseDate($data['expected_purchase_date']);
        $this->comments($data['comments']);
    }

    /**
     * @param string $salutation
     */
    private function salutation(string $salutation)
    {
        # salutation Mr., Ms., Mrs., Dr.
        if (!in_array($salutation, ['Mr.', 'Ms.', 'Mrs.', 'Dr.'])) {
            throw new \InvalidArgumentException('Salutation must be Mr., Ms., Mrs., Dr.');
        }
    }

    /**
     * @param string $assetClass
     */
    private function assetClass(string $assetClass)
    {
        # asset class Large / Mid / Small
        if (!in_array($assetClass, ['Large', 'Mid', 'Small'])) {
            throw new \InvalidArgumentException('Asset class must be Large / Mid / Small');
        }
    }

    /**
     * Zip Code has no type, we want to handle explicitly case when it is not an integer.
     * @param string $country
     * @param $zipCode
     */
    private function usaZipCode(string $country, $zipCode)
    {
        #Zip Code is required for USA and should only accept digits
        if ($country === 'United States (USA)') {
            if (empty($zipCode)) {
                throw new \InvalidArgumentException('Zip code is required for United States');
            }

            $zipCodeIsValid = filter_var($zipCode, FILTER_VALIDATE_INT);

            if ($zipCodeIsValid === false) {
                throw new \InvalidArgumentException('Zip Code must contain only digits for USA.');
            }
        }
    }

    /**
     * @param string $expected_purchase_date
     * @throws \Exception
     */
    private function expectedPurchaseDate(string $expected_purchase_date)
    {
        $now = new \DateTime();
        $date = \DateTime::createFromFormat('Y-m-d', $expected_purchase_date);

        if ($date <= $now) {
            throw new \InvalidArgumentException('The expected purchase date must be in future.');
        }
    }

    /**
     * @param string $comments
     */
    private function comments(string $comments)
    {
        if (strlen($comments) > 500) {
            throw new \InvalidArgumentException('The comment can be max 500 symbols');
        }
    }

    private function resolveCountry($country)
    {
        $countriesByName = [
            'United States' => 'United States (USA)',
            'Canada' => 'Canada (CAN)',
            'United Kingdom' => 'United Kingdom (GBR)',
            'India' => 'India (IND)',
            'Cuba' => 'Cuba (CUB)',
        ];

        $countriesByCode = [
            'USA' => 'United States (USA)',
            'CAN' => 'Canada (CAN)',
            'GBR' => 'United Kingdom (GBR)',
            'IND' => 'India (IND)',
            'CUB' => 'Cuba (CUB)',
        ];

        $countriesWithCode = array_values($countriesByName);

        $countryWithCode = isset($countriesByName[$country]) ? $countriesByName[$country] : $country;

        # if didn't pick the value from countries by name let's try in countries by code
        if (!in_array($countryWithCode, $countriesWithCode)){
            $countryWithCode = isset($countriesByCode[$country]) ? $countriesByCode[$country] : $country;
        }

        return $countryWithCode;
    }
}
