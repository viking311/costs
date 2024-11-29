<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Repository;

use Viking311\Costs\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /**
     * @param string $userName
     * @param int $chatId
     * @return User|null
     */
    public function getByUserNameAndChatId(string $userName, int $chatId): ?User;

    /**
     * @param User $user
     * @return void
     * @throws RepositoryException
     */
    public function save(User $user): void;
}
