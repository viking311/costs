<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use InvalidArgumentException;

readonly class Comment
{
    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        if (empty($this->value)) {
            throw new InvalidArgumentException('Comment can\'t be empty');
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
