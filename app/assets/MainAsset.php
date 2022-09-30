<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Description of MainAsset
 *
 * @author kotov
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'build/css/main.css',
    ];
    public $js = [
         'build/scripts/main.js',
    ];
    public $depends = [
        YiiAsset::class
    ];
}
