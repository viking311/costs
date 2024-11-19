<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected array $aliases = ['join', 'register'];
    protected string $description = 'Start Command to get you started';

    public function handle(): void
    {
        # username from Update object to be used as fallback.
        $fallbackUsername = $this->getUpdate()->getMessage()->from->username;

        # Get the username argument if the user provides,
        # (optional) fallback to username from Update object as the default.
        $username = $this->argument(
            'username',
            $fallbackUsername
        );

        $this->replyWithMessage([
            'text' => "Hello {$username}! Welcome to our bot, Here are our available commands:"
        ]);

        # This will update the chat status to "typing..."
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        # Get all the registered commands.
        $commands = $this->getTelegram()->getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this->replyWithMessage(['text' => $response]);

//        if($this->argument('age', 0) >= 18) {
//            $this->replyWithMessage(['text' => 'Congrats, You are eligible to buy premimum access to our membership!']);
//        } else {
//            $this->replyWithMessage(['text' => 'Sorry, you are not eligible to access premium membership yet!']);
//        }
    }
}

