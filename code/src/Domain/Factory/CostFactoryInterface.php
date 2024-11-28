<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Factory;

use DateTimeImmutable;
use Viking311\Costs\Domain\Entity\Cost;

interface CostFactoryInterface
{
    public function create(
        int $userId,
        DateTimeImmutable $costDate,
        float $amount,
        string $comment
    ):Cost;
}
