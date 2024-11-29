<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\ValueObject;

use InvalidArgumentException;

readonly class UserName
{
    /**
     * @param string $value
     *
     * @throw InvalidArgumentException
     */
    public function __construct(
        private string $value
    )
    {
        if (empty($this->value)) {
            throw new InvalidArgumentException('UserName cannot be empty');
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
