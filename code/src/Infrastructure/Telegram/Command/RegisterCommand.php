<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use Telegram\Bot\Commands\Command;
use Throwable;
use Viking311\Costs\Application\UseCase\RegisterUser\RegisterUserRequest;
use Viking311\Costs\Application\UseCase\RegisterUser\RegisterUserUseCase;

class RegisterCommand extends Command
{

    protected string $name = 'register';
    protected array $aliases = ['join'];
    protected string $description = 'Register user in bot';

    public function __construct(
        private readonly RegisterUserUseCase $registerUserUseCase
    ) {
    }


    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        $username = $this->getUpdate()->getMessage()->from->username;
        $chatId = (int) $this->getUpdate()->getChat()->id;
        $request = new RegisterUserRequest(
            $username,
            $chatId
        );

        try {
            ($this->registerUserUseCase)($request);
            $this->replyWithMessage([
                'text' => "You are registered successfully"
            ]);

        } catch (Throwable ) {
            $this->replyWithMessage([
                'text' => "Something wrong. Try again later."
            ]);
        }
    }
}
