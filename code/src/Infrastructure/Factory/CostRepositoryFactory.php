<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory;

use Viking311\Costs\Domain\Repository\CostRepositoryInterface;
use Viking311\Costs\Infrastructure\Repository\CostRepository;

class CostRepositoryFactory
{
    /**
     * @return CostRepositoryInterface
     */
    public static function create(): CostRepositoryInterface
    {
        $pdo = PdoFactory::getPdo();

        return new CostRepository($pdo);
    }
}
