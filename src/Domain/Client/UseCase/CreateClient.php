<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase;

final class CreateClient
{
    final public function handle(array $data)
    {
        #in DTO validate that e-mail is e-mail via input_filter()

        # validate if e-amil is in db

        # add to email list : maybe I should have a separate table and use case for it,
        # to reduce load on the load on the user table it's better to keep it in a separate table
    }
}
