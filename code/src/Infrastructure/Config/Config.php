<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Config;

class Config
{
    public readonly string $telegramBotToken;
    public readonly string $telegramBotApiUrl;
    public readonly string $hookUrl;
    public readonly string $dbConnection;
    public readonly string $dbHost;
    public readonly int $dbPort;
    public readonly string $dbName;
    public readonly string $dbUser;
    public readonly string $dbPassword;

    public function __construct()
    {
        $this->telegramBotApiUrl = $this->env('TELEGRAM_BOT_API_URL', '');
        $this->telegramBotToken =$this->env('TELEGRAM_BOT_TOKEN', '');
        $this->hookUrl = $this->env('TELEGRAM_HOOK_URL', '');
        $this->dbConnection = $this->env('DB_CONNECTION', 'pgsql');
        $this->dbHost = $this->env('DB_HOST', 'localhost');
        $this->dbPort = (int) $this->env('DB_PORT', '5432');
        $this->dbName = $this->env('DB_DATABASE', '');
        $this->dbUser = $this->env('DB_USERNAME', '');
        $this->dbPassword = $this->env('DB_PASSWORD', '');
    }

    private function env(string $key, mixed $default = false): mixed
    {
        $value = getenv($key);

        if ($value === false) {
            return  $default;
        }

        return $value;
    }
}
