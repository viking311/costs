<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

class GetLastCostsResponse
{
    /**
     * @param LastCostItem[] $items
     */
    public function __construct(
        public readonly array $items
    ) {
    }
}
