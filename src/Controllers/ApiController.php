<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class ApiController
{
    /**
     * @param array $data
     */
    protected function responseWithJson(array $data): void
    {
        $encoded = json_encode($data);

        if ($encoded === false) {
            throw new \InvalidArgumentException('Data is not serializable.');
        }

        echo $encoded;
    }
}
