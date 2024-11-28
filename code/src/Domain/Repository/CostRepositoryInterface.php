<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Repository;

use Viking311\Costs\Domain\Entity\Cost;

interface CostRepositoryInterface
{
    /**
     * @param int $userId
     * @param string $sort
     * @param int $limit
     * @return Cost[]
     */
    public function getCostsByUserId(int $userId, string $sort = 'ASC',  int $limit = 0): array;

    public function save(Cost $cost);
}
