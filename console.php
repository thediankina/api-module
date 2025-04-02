<?php

$container = require __DIR__ . '/container.php';
$db = require __DIR__ . '/database.php';

return [
    'id' => 'app-console',
    'basePath' => __DIR__,
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'container' => $container,
    'components' => [
        'db' => $db,
        'snowflake' => [
            'class' => 'xutl\snowflake\Snowflake',
            'workerId' => 0,
            'dataCenterId' => 0,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];
