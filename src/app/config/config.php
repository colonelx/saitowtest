<?php
$basePath = realpath(__DIR__ . '/../../');
$config = [
    'baseUri' => getenv('BASE_URI') ?  getenv('BASE_URI') :
		(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/",

    'basePath' => $basePath,

    'tiresSqlite3Path' => getenv('SQL_FILE') ?  getenv('SQL_FILE') :
        $basePath . '/DataSources/sql/saitow.db',

    'tiresXmlPath' => getenv('XML_FILE') ?  getenv('XML_FILE') :
        $basePath . '/DataSources/xml/tires.xml',

    'productsPerPage' => getenv('PRODUCTS_PER_PAGE') ?  getenv('PRODUCTS_PER_PAGE') : 10,

        'settings' => [
        'displayErrorDetails' => true,
        'logger' => [
            'name' => 'saitow-app',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../../logs/app.log',
        ],
    ],
];

return $config;
