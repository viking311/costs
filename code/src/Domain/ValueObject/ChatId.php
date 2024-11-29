<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use InvalidArgumentException;

readonly class ChatId
{
    /**
     * @param int $value
     */
    public function __construct(
        private int $value
    ) {
        if ($this->value == 0) {
            throw new InvalidArgumentException('ChatId cannot be zero');
        }
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
