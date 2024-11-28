<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory\UseCase;

use Viking311\Costs\Application\UseCase\GetLastCosts\GetLastCostsUseCase;
use Viking311\Costs\Infrastructure\Factory\CostRepositoryFactory;
use Viking311\Costs\Infrastructure\Factory\UserRepositoryFactory;

class GetLastCostsUseCaseFactory
{
    public static function create(): GetLastCostsUseCase
    {
        $userRepository = UserRepositoryFactory::create();
        $costRepository = CostRepositoryFactory::create();

        return new GetLastCostsUseCase(
          $userRepository,
          $costRepository
        );
    }
}
