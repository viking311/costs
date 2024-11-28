<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory\UseCase;

use Viking311\Costs\Application\UseCase\AddCost\AddCostUseCase;
use Viking311\Costs\Infrastructure\Factory\CostFactory;
use Viking311\Costs\Infrastructure\Factory\CostRepositoryFactory;
use Viking311\Costs\Infrastructure\Factory\UserRepositoryFactory;

class AddCostUseCaseFactory
{
    public static function create(): AddCostUseCase
    {
        $userRepository = UserRepositoryFactory::create();
        $costFactory = new CostFactory();
        $costRepository = CostRepositoryFactory::create();

        return new AddCostUseCase(
            $userRepository,
            $costFactory,
            $costRepository
        );
    }
}
