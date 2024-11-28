<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Entity;

use Viking311\Costs\Domain\ValueObject\Amount;
use Viking311\Costs\Domain\ValueObject\Comment;
use Viking311\Costs\Domain\ValueObject\CostDate;

class Cost
{
    public function __construct(
        private int $userId,
        private CostDate $costDate,
        private Amount $amount,
        private Comment $comment,
        private ?int $id = null
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCostDate(): CostDate
    {
        return $this->costDate;
    }

    public function getAmount(): Amount
    {
        return $this->amount;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
