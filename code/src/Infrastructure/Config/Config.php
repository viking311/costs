<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Config;

class Config
{
    public readonly string $telegramBotToken;
    public readonly string $telegramBotApiUrl;
    public readonly string $hookUrl;

    /**
     * @throws ConfigException
     */
    public function __construct()
    {
        $cfg = parse_ini_file(__DIR__ . '/../../../app.ini', true);
        if ($cfg === false) {
            throw new ConfigException('Cannot parse app.ini file');
        }

        $telegramBotToken = getenv('TELEGRAM_BOT_TOKEN');
        if ($telegramBotToken === false) {
            if (!array_key_exists('telegram', $cfg) || !is_array($cfg['telegram'])) {
                throw new ConfigException('telegram section not exists');
            }

            if (!array_key_exists('bot_token', $cfg['telegram'])) {
                throw new ConfigException('telegram token not exists');
            }

            $telegramBotToken = $cfg['telegram']['bot_token'];
        }
        $this->telegramBotToken = $telegramBotToken;

        $telegramBotApiUrl = getenv('TELEGRAM_BOT_API_URL');
        if ($telegramBotApiUrl === false) {
            if (!array_key_exists('telegram', $cfg) || !is_array($cfg['telegram'])) {
                throw new ConfigException('telegram section not exists');
            }

            if (!array_key_exists('bot_api_url', $cfg['telegram'])) {
                throw new ConfigException('telegram bot api url not exists');
            }

            $telegramBotApiUrl = $cfg['telegram']['bot_api_url'];
        }
        $this->telegramBotApiUrl = $telegramBotApiUrl;

        $hookUrl = getenv('TELEGRAM_HOOK_URL');
        if ($hookUrl === false) {
            if (!array_key_exists('telegram', $cfg) || !is_array($cfg['telegram'])) {
                throw new ConfigException('telegram section not exists');
            }

            if (!array_key_exists('hook_url', $cfg['telegram'])) {
                throw new ConfigException('hook url not exists');
            }

            $hookUrl = $cfg['telegram']['hook_url'];
        }
        $this->hookUrl = $hookUrl;
    }
}
