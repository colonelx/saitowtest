<?php

require 'vendor/autoload.php';
use \Slim\Container;

$dotEnv = new \Dotenv\Dotenv(realpath(__DIR__));
$dotEnv->load();
$config = require 'app/config/config.php';
$app = require 'app/config/router.php';
$views = require 'app/config/views.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'config' => $config,
    'app' => $app,
    'view' => $views
];

$container = new Container($configuration);

return $container;
