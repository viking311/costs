<?php

declare(strict_types=1);

use Viking311\Costs\Infrastructure\Config\Config;

require __DIR__ . '/vendor/autoload.php';

$config = new Config();

$getQuery = array(
    "url" => $config->hookUrl,
);

$ch = curl_init($config->telegramBotApiUrl . $config->telegramBotToken ."/setWebhook?" . http_build_query($getQuery));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

$resultQuery = curl_exec($ch);
curl_close($ch);

echo $resultQuery;