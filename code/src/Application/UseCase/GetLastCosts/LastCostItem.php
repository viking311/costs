<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

readonly class LastCostItem
{
    /**
     * @param string $costDate
     * @param float $amount
     * @param string $comment
     */
    public function __construct(
        public string $costDate,
        public float  $amount,
        public string $comment
    ) {
    }
}
