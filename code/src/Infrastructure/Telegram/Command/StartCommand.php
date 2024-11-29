<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /** @var string  */
    protected string $name = 'start';
    /** @var array|string[]  */
    protected array $aliases = ['help',];
    /** @var string  */
    protected string $description = "Start Command to get you information about exists commands\n";

    /**
     * @return void
     */
    public function handle(): void
    {
        $username = $this->getUpdate()->getMessage()->from->username;

        $this->replyWithMessage([
            'text' => "Hello $username!\nWelcome to our bot!\nHere are our available commands:"
        ]);

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $commands = $this->getTelegram()->getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this->replyWithMessage(['text' => $response]);
    }
}

