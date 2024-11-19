<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Factory;

use Viking311\Costs\Domain\Entity\User;

interface UserFactoryInterface
{
    public function create(
        string $userName,
        int $chatId
    ): User;
}
