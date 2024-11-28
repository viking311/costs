<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram\Command;

use Telegram\Bot\Commands\Command;
use Viking311\Costs\Application\UseCase\GetLastCosts\GetLastCostRequest;
use Viking311\Costs\Application\UseCase\GetLastCosts\GetLastCostsUseCase;

class GetLastRecordsCommand extends Command
{
    protected string $name = 'last_costs';
    protected string $description = 'Return N lastCosts';

    public function __construct(
        private GetLastCostsUseCase $costsUseCase
    )
    {
    }


    /**
     * @inheritDoc
     */
    public function handle()
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
                $resText .= "Date: {$item->costDate}\nAmount: {$item->amount}\nYour comment: {$item->comment}\n\n\n";
            }
            if (empty($resText)) {
                $resText  = 'You don\'t have any costs';
            }
            $this->replyWithMessage([
                'text' => $resText
            ]);

        } catch (\Throwable $e) {
            $this->replyWithMessage([
                'text' => $e->getMessage()
//                'text' => "Something wrong. Try again later."
            ]);
            return;
        }
    }
}
