<?php

declare(strict_types=1);
$token = "7866534109:AAEm2hMQ8iDpwlX_OtcDbA0bKK57Vedpn-w";

$getQuery = array(
    "url" => "http://localhost/telegram/hook",
);
$ch = curl_init("http://localhost:8081/bot". $token ."/setWebhook?" . http_build_query($getQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

$resultQuery = curl_exec($ch);
curl_close($ch);

echo $resultQuery;