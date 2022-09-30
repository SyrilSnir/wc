<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Description of DashboardAsset
 *
 * @author kotov
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'build/css/dashboard.css',
    ];
    public $js = [
         'build/scripts/dashboard.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapScriptsAsset::class
    ];
}
