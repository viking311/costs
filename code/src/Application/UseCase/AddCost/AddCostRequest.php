<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\AddCost;

use DateTimeImmutable;

class AddCostRequest
{
    public function __construct(
        public readonly string $userName,
        public readonly int $chatId,
        public readonly DateTimeImmutable $costDate,
        public readonly float $amount,
        public readonly string $comment
    ) {
    }
}
