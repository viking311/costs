<?php

declare(strict_types=1);

namespace Viking311\Costs\Domain\Entity;

use Viking311\Costs\Domain\ValueObject\Amount;
use Viking311\Costs\Domain\ValueObject\Comment;
use Viking311\Costs\Domain\ValueObject\CostDate;

class Cost
{
    /**
     * @param int $userId
     * @param CostDate $costDate
     * @param Amount $amount
     * @param Comment $comment
     * @param int|null $id
     */
    public function __construct(
        private int $userId,
        private CostDate $costDate,
        private Amount $amount,
        private Comment $comment,
        private ?int $id = null
    ) {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return CostDate
     */
    public function getCostDate(): CostDate
    {
        return $this->costDate;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
