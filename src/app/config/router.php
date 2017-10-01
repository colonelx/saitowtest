<?php

use Psr\Container\ContainerInterface;
use Saitow\Middleware\SessionMiddleware;
use Slim\App;

$app_container = function (ContainerInterface $c) {
    $app = new App($c);
    // routes and middlewares here

    $app->get('/', function ($request, $response) {
        return $response->withRedirect('/home');
    });

    $app->get(
        '/home[/[{page}]]',
        Saitow\Controller\HomeController::class . ':indexAction'
    )->add(new SessionMiddleware());


    $app->get(
        '/search[/{term}[/{page}]]',
        Saitow\Controller\HomeController::class . ':searchAction'
    )->add(new SessionMiddleware());

    $app->get(
        '/item/{dataSource}_{refId}',
        Saitow\Controller\HomeController::class . ':itemAction'
    );

    $app->post(
        '/changeOrder',
        \Saitow\Controller\HomeController::class . ':changeOrderAction'
    )->add(new SessionMiddleware());

    $app->get('/info', function () {
        phpinfo();
        exit();
    });

    return $app;
};

return $app_container;
