<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\assets;

use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * Description of BootstrapScriptsAsset
 *
 * @author kotov
 */
class BootstrapScriptsAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';

    public $css = [
        "https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    ];
    public $js = [
         'js/bootstrap.min.js',        
    ];
    
    public $depends = [
        BootstrapAsset::class
    ];
}
    

