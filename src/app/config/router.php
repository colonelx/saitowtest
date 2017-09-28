<?php

use Psr\Container\ContainerInterface;
use Slim\App;

$app_container = function (ContainerInterface $c) {
    $app = new App($c);
    // routes and middlewares here

    $app->get('/', function ($request, $response, $args) {
        return $response->withRedirect('/home/');
    });
    $app->get('/home[/]', Saitow\Controller\HomeController::class . ':indexAction');

    return $app;
};

return $app_container;
