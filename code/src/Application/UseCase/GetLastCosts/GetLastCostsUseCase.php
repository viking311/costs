<?php

declare(strict_types=1);

namespace Viking311\Costs\Application\UseCase\GetLastCosts;

use Exception;
use Viking311\Costs\Domain\Repository\CostRepositoryInterface;
use Viking311\Costs\Domain\Repository\UserRepositoryInterface;

class GetLastCostsUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CostRepositoryInterface $costRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetLastCostRequest $request): GetLastCostsResponse
    {
        $user = $this->userRepository->getByUserNameAndChatId(
            $request->userName,
            $request->chatId
        );

        if (is_null($user)) {
            throw new Exception('User not Register');
        }

        $costs = $this->costRepository->getCostsByUserId(
            $user->getId(),
            'DESC',
            $request->count
        );

        $result = [];

        foreach ($costs as $cost) {
            $result[] = new LastCostItem(
                $cost->getCostDate()->getValue()->format('Y-m-d H:i'),
                $cost->getAmount()->getValue(),
                $cost->getComment()->getValue()
            );
        }

        return new GetLastCostsResponse($result);
    }
}
