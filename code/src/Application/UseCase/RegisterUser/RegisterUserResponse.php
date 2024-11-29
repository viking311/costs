<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\RegisterUser;

readonly class RegisterUserResponse
{
    /**
     * @param int $id
     */
    public function __construct(
        public int $id
    ) {
    }
}
