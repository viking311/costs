<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\RegisterUser;

readonly class RegisterUserRequest
{
    /**
     * @param string $userName
     * @param int $chatId
     */
    public function __construct(
        public string $userName,
        public int    $chatId
    ) {
    }
}
