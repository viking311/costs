<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

readonly class GetLastCostsResponse
{
    /**
     * @param LastCostItem[] $items
     */
    public function __construct(
        public array $items
    ) {
    }
}
