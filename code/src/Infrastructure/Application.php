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
    /**
     * @return void
     */
    public function run(): void
    {
        $app = AppFactory::create();

        $app->addRoutingMiddleware();
        $errorMiddleware = $app->addErrorMiddleware(true, true, true);


        $app->post('/telegram/hook', function (RequestInterface $request, ResponseInterface $response) {
            try {
                $telegram = TelegramFactory::createInstance();
                $telegram->commandsHandler(true);
            } catch (Throwable) {
                //TODO добавить тут логирование
            }
            return $response;
        });

        $app->run();
    }
}
