<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use DateMalformedStringException;
use DateTimeImmutable;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Throwable;
use Viking311\Costs\Application\UseCase\AddCost\AddCostRequest;
use Viking311\Costs\Application\UseCase\AddCost\AddCostUseCase;

class AddCoastCommand extends Command
{
    protected string $name = 'add_cost';
    protected array $aliases = ['cost'];
    protected string $description = "Add new cost.\nExample of message:\n /add_cost\n 2014-11-25 10:15\n10.5\nmy cost comment\n";

    public function __construct(
        private AddCostUseCase $addCostUseCase
    ) {
    }

    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        $text = $this->getUpdate()->getMessage()->text;
        $costArr = explode("\n", $text);

        if (count($costArr) != 4) {
            $this->replyWithMessage(['text' => 'incorrect data format.']);
        }

        try {
            $date = new DateTimeImmutable($costArr[1]);
            $amount = (float) $costArr[2];
            $comment = $costArr[3];
            $username = $this->getUpdate()->getMessage()->from->username;
            $chatId = (int) $this->getUpdate()->getChat()->id;

            $request = new AddCostRequest(
                $username,
                $chatId,
                $date,
                $amount,
                $comment
            );
            ($this->addCostUseCase)($request);
        } catch (DateMalformedStringException) {
            $this->replyWithMessage([
                'text' => 'Date must be in format "YYYY-mm-dd HH:mm"'
            ]);
            return;
        } catch (Throwable) {
            $this->replyWithMessage([
                'text' => "Something wrong. Try again later."
            ]);
            return;
        }

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage(['text' => "Saved" ]);
    }
}
