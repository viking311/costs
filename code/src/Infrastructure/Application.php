<?php

declare(strict_types=1);

namespace Viking311\Costs\Infrastructure;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Factory\AppFactory;
use Throwable;
use Viking311\Costs\Infrastructure\Telegram\TelegramFactory;

class Application
{
    public function run(): void
    {
        $app = AppFactory::create();

        $app->addRoutingMiddleware();
        $errorMiddleware = $app->addErrorMiddleware(true, true, true);


        $app->post('/telegram/hook', function (RequestInterface $request, ResponseInterface $response) {
            try {
                $telegram = TelegramFactory::createInstance();
                $update = $telegram->commandsHandler(true);
                file_put_contents('/tmp/test.txt', var_export($update, true));
            } catch (Throwable $e) {
                //TODO добавить тут логирование
            }
            return $response;
        });

        $app->run();
    }
}
