<?php

require 'vendor/autoload.php';
use \Slim\Container;

$dotEnv = new \Dotenv\Dotenv(realpath(__DIR__));
$dotEnv->load();
$config = require 'app/config/config.php';
$app = require 'app/config/router.php';

// Services
$views = require 'app/config/views.php';

// Tire Data Sources init.
$tiresSqlDataSource = new Saitow\Library\TiresDataSources\TiresSqlDataSource($config['tiresSqlite3Path']);
$tiresXmlDataSource = new Saitow\Library\TiresDataSources\TiresXmlDataSource($config['tiresXmlPath']);

// Configurations
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'config' => $config,
    'app' => $app,
    'view' => $views,

    // Repositories
    'tiresRepository' => new \Saitow\Library\TiresRepository([
        $tiresSqlDataSource,
        $tiresXmlDataSource
    ])
];

$container = new Container($configuration);

return $container;
