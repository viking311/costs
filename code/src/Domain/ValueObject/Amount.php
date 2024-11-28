<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use InvalidArgumentException;

class Amount
{
    public function __construct(
        private readonly float $value
    ) {
        if ($this->value < 0) {
            throw new InvalidArgumentException('Amount must be great than zero');
        }
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
