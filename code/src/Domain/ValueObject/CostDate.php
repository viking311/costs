<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use DateTimeImmutable;

readonly class CostDate
{
    /**
     * @param DateTimeImmutable $value
     */
    public function __construct(
        private DateTimeImmutable $value
    ) {
    }

    /**
     * @return DateTimeImmutable
     */
    public function getValue(): DateTimeImmutable
    {
        return $this->value;
    }
}
