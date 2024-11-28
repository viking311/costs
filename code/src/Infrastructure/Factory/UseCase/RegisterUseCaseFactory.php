<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory\UseCase;

use Viking311\Costs\Application\UseCase\RegisterUser\RegisterUserUseCase;
use Viking311\Costs\Infrastructure\Factory\UserFactory;
use Viking311\Costs\Infrastructure\Factory\UserRepositoryFactory;

class RegisterUseCaseFactory
{
    public static function create(): RegisterUserUseCase
    {
        $userFactory = new UserFactory();
        $userRepository = UserRepositoryFactory::create();

        return new RegisterUserUseCase(
            $userFactory,
            $userRepository
        );
    }
}
