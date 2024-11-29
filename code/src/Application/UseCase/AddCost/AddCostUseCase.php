<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\AddCost;

use Exception;
use Viking311\Costs\Domain\Factory\CostFactoryInterface;
use Viking311\Costs\Domain\Repository\CostRepositoryInterface;
use Viking311\Costs\Domain\Repository\UserRepositoryInterface;

readonly class AddCostUseCase
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param CostFactoryInterface $costFactory
     * @param CostRepositoryInterface $costRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CostFactoryInterface    $costFactory,
        private CostRepositoryInterface $costRepository
    ) {
    }

    /**
     * @param AddCostRequest $request
     * @return void
     * @throws Exception
     */
    public function __invoke(AddCostRequest $request): void
    {
        $user = $this->userRepository->getByUserNameAndChatId(
            $request->userName,
            $request->chatId
        );

        if (is_null($user)) {
            throw new Exception('User not Register');
        }

        $cost = $this->costFactory->create(
            $user->getId(),
            $request->costDate,
            $request->amount,
            $request->comment
        );

        $this->costRepository->save($cost);
    }
}
