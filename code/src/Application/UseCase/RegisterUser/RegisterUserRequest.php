<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\RegisterUser;

class RegisterUserRequest
{
    public function __construct(
        public readonly string $userName,
        public readonly int $chatId
    ) {
    }
}
