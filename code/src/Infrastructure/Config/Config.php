<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Config;

readonly class Config
{
    /** @var string */
    public string $telegramBotToken;
    /** @var string */
    public string $telegramBotApiUrl;
    /** @var string */
    public string $hookUrl;
    /** @var string */
    public string $dbConnection;
    /** @var string */
    public string $dbHost;
    /** @var int */
    public int $dbPort;
    /** @var string */
    public string $dbName;
    /** @var string */
    public string $dbUser;
    /** @var string */
    public string $dbPassword;

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

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    private function env(string $key, mixed $default = false): mixed
    {
        $value = getenv($key);

        if ($value === false) {
            return  $default;
        }

        return $value;
    }
}
