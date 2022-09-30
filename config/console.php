<?php

use app\core\services\auth\UserIdentity;
use yii\log\FileTarget;
use yii\rbac\PhpManager;

return [
    'id' => 'wc',
    'basePath' => realpath(__DIR__ .'/../'),
    'name' => 'Хочу, могу!',
    'version' => '0.0.1',
    'controllerNamespace' => 'app\commands\controllers',    
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning','info'],
                    'logVars' => ['_GET', '_POST'],
                ],
            ],
        ],   
        'authManager' => [
            'class' => PhpManager::class,
        ],        
    ]    
];


