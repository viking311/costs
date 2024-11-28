<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory;

use DateTimeImmutable;
use Viking311\Costs\Domain\Entity\Cost;
use Viking311\Costs\Domain\Factory\CostFactoryInterface;
use Viking311\Costs\Domain\ValueObject\Amount;
use Viking311\Costs\Domain\ValueObject\Comment;
use Viking311\Costs\Domain\ValueObject\CostDate;

class CostFactory implements CostFactoryInterface
{

    public function create(int $userId, DateTimeImmutable $costDate, float $amount, string $comment): Cost
    {
        return new Cost(
            $userId,
            new CostDate($costDate),
            new Amount($amount),
            new Comment($comment)
        );
    }
}
