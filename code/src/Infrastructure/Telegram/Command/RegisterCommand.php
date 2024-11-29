<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use Telegram\Bot\Commands\Command;
use Throwable;
use Viking311\Costs\Application\UseCase\RegisterUser\RegisterUserRequest;
use Viking311\Costs\Application\UseCase\RegisterUser\RegisterUserUseCase;

class RegisterCommand extends Command
{
    /** @var string  */
    protected string $name = 'register';
    /** @var array|string[]  */
    protected array $aliases = ['join'];
    /** @var string  */
    protected string $description = "Register user in bot without it you can't save your costs\n";

    /**
     * @param RegisterUserUseCase $registerUserUseCase
     */
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
