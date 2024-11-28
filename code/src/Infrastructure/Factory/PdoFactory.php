<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure\Factory;

use PDO;
use Viking311\Costs\Infrastructure\Config\Config;

class PdoFactory
{
    private static ?PDO $pdo = null;

    public static function getPdo(): PDO
    {
        if (is_null(self::$pdo)) {
            $config = new Config();

            $dsn = sprintf(
                $config->dbConnection . ':host=%s;port=%s;dbname=%s;user=%s;password=%s',
                $config->dbHost,
                $config->dbPort,
                $config->dbName,
                $config->dbUser,
                $config->dbPassword,
            );

            self::$pdo = new PDO($dsn);
        }

        return self::$pdo;
    }
}
