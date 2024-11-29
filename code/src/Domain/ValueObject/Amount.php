<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use InvalidArgumentException;

readonly class Amount
{
    /**
     * @param float $value
     */
    public function __construct(
        private float $value
    ) {
        if ($this->value < 0) {
            throw new InvalidArgumentException('Amount must be great than zero');
        }
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}
