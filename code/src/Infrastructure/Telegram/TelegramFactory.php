<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Telegram;

use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Viking311\Costs\Infrastructure\Config\Config;
use Viking311\Costs\Infrastructure\Telegram\Command\AddCoastCommand;
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
            AddCoastCommand::class,
        ]);
        return $telegram;
    }
}
