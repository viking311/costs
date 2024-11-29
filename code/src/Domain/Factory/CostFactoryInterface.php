<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Factory;

use DateTimeImmutable;
use Viking311\Costs\Domain\Entity\Cost;

interface CostFactoryInterface
{
    /**
     * @param int $userId
     * @param DateTimeImmutable $costDate
     * @param float $amount
     * @param string $comment
     * @return Cost
     *
     */
    public function create(
        int $userId,
        DateTimeImmutable $costDate,
        float $amount,
        string $comment
    ):Cost;
}
