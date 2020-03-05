<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class ApiController
{
    /**
     * @param array $data
     * @param int $code
     */
    protected function responseWithJson(array $data, int $code): void
    {
        $encoded = json_encode($data);

        if ($encoded === false) {
            throw new \InvalidArgumentException('Data is not serializable.');
        }

        header('Content-Type: application/json');
        http_response_code($code);
        # add a header?
        echo $encoded;
    }
}
