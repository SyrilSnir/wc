<?php
use yii\gii\Module as GiiModule;
use yii\debug\Module as DebugModule;

return [
    'bootstrap' => [
        'debug',
        'gii',
    ],
    'modules' => [
        'gii' => [
            'class' => GiiModule::class,
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
            ],
        'debug' => [
            'class' => DebugModule::class,
            // uncomment and adjust the following to add your IP if you are not connecting from localhost.
             'allowedIPs' => ['127.0.0.1', '::1','149.126.169.175'],
            ],
    ],    
];