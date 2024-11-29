<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

readonly class GetLastCostRequest
{
    /**
     * @param string $userName
     * @param int $chatId
     * @param int $count
     */
    public function __construct(
        public string $userName,
        public int    $chatId,
        public int    $count
    ) {
    }
}
