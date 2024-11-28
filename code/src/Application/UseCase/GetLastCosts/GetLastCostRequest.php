<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

class GetLastCostRequest
{
    public function __construct(
        public readonly string $userName,
        public readonly int $chatId,
        public readonly int $count
    ) {
    }
}
