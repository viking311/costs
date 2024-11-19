<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use DateMalformedStringException;
use DateTimeImmutable;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class AddCoastCommand extends Command
{

    protected string $name = 'add_cost';
    protected array $aliases = ['cost'];
    protected string $description = 'Add new cost';
    protected string $pattern = '{costData}';

    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        $costData = $this->argument('costData', '');
        $costArr = explode("\n", $costData);
        if (count($costArr) != 3) {
            $this->replyWithMessage(['text' => 'incorrect format' ]);
        }

        try {
            $date = new DateTimeImmutable($costArr[0]);
        } catch (\DateMalformedStringException) {
            $date = new DateTimeImmutable();
        }

        $amount = $costArr[1];
        $comment = $costArr[2];

        $this->replyWithChatAction(['action' => Actions::TYPING]);

//        $this->replyWithMessage(['text' => "dt: {$date->format()} \n am: $amount \n com: $comment" ]);
    }
}
