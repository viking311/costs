<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram;

use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Viking311\Costs\Infrastructure\Config\Config;
use Viking311\Costs\Infrastructure\Factory\UseCase\AddCostUseCaseFactory;
use Viking311\Costs\Infrastructure\Factory\UseCase\GetLastCostsUseCaseFactory;
use Viking311\Costs\Infrastructure\Factory\UseCase\RegisterUseCaseFactory;
use Viking311\Costs\Infrastructure\Telegram\Command\AddCoastCommand;
use Viking311\Costs\Infrastructure\Telegram\Command\GetLastRecordsCommand;
use Viking311\Costs\Infrastructure\Telegram\Command\RegisterCommand;
use Viking311\Costs\Infrastructure\Telegram\Command\StartCommand;

class TelegramFactory
{
    /**
     * @throws TelegramSDKException
     */
    public static function createInstance():Api
    {
        $config = new Config();

        $telegram = new Api(
            $config->telegramBotToken,
            false,
            null,
            $config->telegramBotApiUrl
        );

        $telegram->addCommands([
            StartCommand::class,
        ]);

        $registerUseCase = RegisterUseCaseFactory::create();
        $registerCommand = new RegisterCommand($registerUseCase);
        $telegram->addCommand($registerCommand);

        $addCostUseCase = AddCostUseCaseFactory::create();
        $addCostCommand = new AddCoastCommand($addCostUseCase);
        $telegram->addCommand($addCostCommand);

        $lastCostsUseCase = GetLastCostsUseCaseFactory::create();
        $lastCostsCommand = new GetLastRecordsCommand($lastCostsUseCase);
        $telegram->addCommand($lastCostsCommand);

        return $telegram;
    }
}
