<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use Telegram\Bot\Commands\Command;
use Throwable;
use Viking311\Costs\Application\UseCase\GetLastCosts\GetLastCostRequest;
use Viking311\Costs\Application\UseCase\GetLastCosts\GetLastCostsUseCase;

class GetLastRecordsCommand extends Command
{
    /** @var string  */
    protected string $name = 'last_costs';
    /** @var string  */
    protected string $description = "Return N last costs.\nExample of message:\n/last_costs\n 10\n";

    /**
     * @param GetLastCostsUseCase $costsUseCase
     */
    public function __construct(
        private readonly GetLastCostsUseCase $costsUseCase
    ) {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $text = $this->getUpdate()->getMessage()->text;
        $costArr = explode("\n", $text);

        if (count($costArr) != 2) {
            $this->replyWithMessage(['text' => 'incorrect data format.']);
        }

        try {
            $request = new GetLastCostRequest(
                $this->getUpdate()->getMessage()->from->username,
                (int)$this->getUpdate()->getChat()->id,
                (int)$costArr[1]
            );
            $response = ($this->costsUseCase)($request);
            $resText = '';

            foreach ($response->items as $item) {
                $resText .= "Date: $item->costDate\nAmount: $item->amount\nYour comment: $item->comment\n\n\n";
            }
            if (empty($resText)) {
                $resText  = 'You don\'t have any costs';
            }
            $this->replyWithMessage([
                'text' => $resText
            ]);

        } catch (Throwable) {
            $this->replyWithMessage([
                'text' => "Something wrong. Try again later."
            ]);
            return;
        }
    }
}
