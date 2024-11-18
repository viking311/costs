<?php

declare(strict_types=1);

require 'vendor/autoload.php';

$app = \Slim\Factory\AppFactory::create();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true,true, true);

$app->get('/', function (\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response){
    var_dump($request);
    return $response;
});

$app->post('/telegram/hook', function (\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response){
    file_put_contents('/tmp/test.txt', $request->getBody()->getContents());
    return $response;
});

$app->get('/telegram/hook', function (\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response){
   var_dump(4444);
    return $response;
});

$app->run();
