<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory;

use Viking311\Costs\Domain\Entity\User;
use Viking311\Costs\Domain\Factory\UserFactoryInterface;
use Viking311\Costs\Domain\ValueObject\ChatId;
use Viking311\Costs\Domain\ValueObject\UserName;

class UserFactory implements UserFactoryInterface
{
    /**
     * @param string $userName
     * @param int $chatId
     * @return User
     */
    public function create(string $userName, int $chatId): User
    {
        return new User(
            new UserName($userName),
            new ChatId($chatId)
        );
    }
}
