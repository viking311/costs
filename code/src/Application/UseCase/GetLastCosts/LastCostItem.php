<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

class LastCostItem
{
    public function __construct(
        public readonly string $costDate,
        public readonly float $amount,
        public readonly string $comment
    ){
    }
}
