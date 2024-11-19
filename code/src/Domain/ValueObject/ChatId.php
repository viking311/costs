<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use InvalidArgumentException;

class ChatId
{
    public function __construct(
        private readonly int $value
    )
    {
        if ($this->value == 0) {
            throw new InvalidArgumentException('ChatId cannot be zero');
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
