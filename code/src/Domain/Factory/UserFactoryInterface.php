<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Factory;

use Viking311\Costs\Domain\Entity\User;

interface UserFactoryInterface
{
    /**
     * @param string $userName
     * @param int $chatId
     * @return User
     */
    public function create(
        string $userName,
        int $chatId
    ): User;
}
