<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\RegisterUser;

use Viking311\Costs\Infrastructure\Factory\UserFactory;
use Viking311\Costs\Infrastructure\Repository\UserRepository;

class RegisterUserUseCase
{
    public function __construct(
        private UserFactory $userFactory,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(RegisterUserRequest $request): RegisterUserResponse
    {
        $user = $this->userRepository->getByUserNameAndChatId(
            $request->userName,
            $request->chatId
        );
        if (is_null($user)) {
            $user = $this->userFactory->create(
                $request->userName,
                $request->chatId
            );
            $this->userRepository->save($user);
        }

        return new RegisterUserResponse(
            $user->getId()
        );
    }
}
