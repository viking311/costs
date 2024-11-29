<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\AddCost;

use DateTimeImmutable;

readonly class AddCostRequest
{
    /**
     * @param string $userName
     * @param int $chatId
     * @param DateTimeImmutable $costDate
     * @param float $amount
     * @param string $comment
     */
    public function __construct(
        public string            $userName,
        public int               $chatId,
        public DateTimeImmutable $costDate,
        public float             $amount,
        public string            $comment
    ) {
    }
}
