<?php

use app\bootstrap\SetupApplication;
use app\core\services\auth\UserIdentity;
use app\models\Data\Languages;
use app\modules\dashboard\Module as Dashboard;
use yii\log\FileTarget;
use yii\rbac\PhpManager;

return [
    'id' => 'wc',
    'basePath' => realpath(__DIR__ .'/../'),
    'name' => 'Хочу, могу!',
    'version' => '0.0.1',
    'viewPath' => '@views',
    'language' => Languages::RUSSIAN,    
    'bootstrap' => [
        SetupApplication::class,
        'log',
    ],      
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],  
    'modules' => [
        'dashboard' => [
            'class' => Dashboard::class,
            'layout' => 'main',
            'defaultRoute' => 'main/index'
        ],
        'gridview' =>  [
           'class' => kartik\grid\Module::class
        ]                
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'FEGLMEGMEGKMKBMKLRTMBKLRSBKLN',
        ],        
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
        'user' => [
            'identityClass' => UserIdentity::class,
            'enableAutoLogin' => false,
        //    'loginUrl' => ['adminka/login'],
        ],  
        'authManager' => [
            'class' => PhpManager::class,
        ],        
    ]
    
];

