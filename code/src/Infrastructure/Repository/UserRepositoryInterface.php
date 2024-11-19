<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Repository;

use Viking311\Costs\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function getById(int $id): ?User;
    public function getByUserName(string $userName): ?User;
    public function save(User $user);
}
