<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory;

use Viking311\Costs\Domain\Repository\UserRepositoryInterface;
use Viking311\Costs\Infrastructure\Repository\UserRepository;

class UserRepositoryFactory
{
    /**
     * @return UserRepositoryInterface
     */
    public static function create(): UserRepositoryInterface
    {
        $pdo = PdoFactory::getPdo();

        return new UserRepository($pdo);
    }
}
