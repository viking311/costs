<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\RegisterUser;

class RegisterUserResponse
{
    public function __construct(
        public readonly int $id
    ) {
    }
}
