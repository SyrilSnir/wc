<?php

Yii::setAlias('@views', dirname(__DIR__) . DIRECTORY_SEPARATOR . 
        'app' .DIRECTORY_SEPARATOR .'views');
Yii::setAlias('@mail', dirname(__DIR__) . DIRECTORY_SEPARATOR . 
        'app' .DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR . 'mail');
Yii::setAlias('@elements', dirname(__DIR__) . DIRECTORY_SEPARATOR . 
        'app' .DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR . 
        'templates'. DIRECTORY_SEPARATOR . 'elements');
Yii::setAlias('@config', dirname(__DIR__) . DIRECTORY_SEPARATOR .
        'config' . DIRECTORY_SEPARATOR . 'parts');
Yii::setAlias('@widgets', dirname(__DIR__) . DIRECTORY_SEPARATOR . 
        'app' . DIRECTORY_SEPARATOR . 'widgets');