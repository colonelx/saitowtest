<?php
$base_path = realpath(__DIR__ . '/../../');
$project_dir = realpath(__DIR__ . '/../../../');
$config = [
    'base_uri' => getenv('BASE_URI') ?  getenv('BASE_URI') :
		(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/",

    'base_path' => $base_path,

    'sqlite3_path' => getenv('SQL_FILE') ?  getenv('SQL_FILE') :
        $project_dir . '/DataSources/sql/saitow.db',

    'xml_path' => getenv('XML_FILE') ?  getenv('XML_FILE') :
        $project_dir . '/DataSources/xml/tires.xml',

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
