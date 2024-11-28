<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

class Comment
{
    public function __construct(
        private string $value
    ) {
        if (empty($this->value)) {
            throw new \InvalidArgumentException('Comment can\'t be empty');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
