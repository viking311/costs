<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use DateTimeImmutable;

class CostDate
{
    public function __construct(
        private readonly DateTimeImmutable $value
    ) {
    }

    public function getValue(): DateTimeImmutable
    {
        return $this->value;
    }
}
