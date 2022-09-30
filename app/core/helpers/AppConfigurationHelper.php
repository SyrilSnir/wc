<?php

namespace app\core\helpers;

use yii\helpers\ArrayHelper;


class AppConfigurationHelper
{
    const WEB_APPLICATION = 'web';
    const CONSOLE_APPLICATION = 'console';
    
    /**
     * 
     * @var string
     */
    private $applicationType;
    
    /**
     * 
     * @var bool
     */
    private $isDebug;
    
    /**
     * 
     * @var string
     */
    private $configDir;
    
    private $paramsFileName;
    
    public function __construct(string $applicationType, bool $isDebug, $configDir = null,$paramsFileName = '')
    {
        $this->applicationType = $applicationType;
        $this->isDebug = $isDebug;
        if (!$configDir) {
            $this->configDir = __DIR__ . '/../../../config/';
        } else {
            $this->configDir = $configDir;
        }
        if (!$paramsFileName) {
            $this->paramsFileName = 'params.php';
        }
            
    }
    
    public function getConfiguration(): array 
    {        
        $baseConfig = [];        
        $componentsConfig = [
          'components' => []
        ];
        $commonConfig = [];
        $paramsConfig = [];
        if ($this->isParamsFileExist()) {
            $paramsConfig['params'] = require $this->paramsFileFullPath();
        }
        $componentsConfig['components']['db'] = require $this->configDir . 'db.php';
        if ($this->applicationType == self::CONSOLE_APPLICATION) {
            $baseConfig = require $this->configDir . 'console.php';
           
        }
        if ($this->applicationType == self::WEB_APPLICATION) {
            $baseConfig = require $this->configDir . 'web.php';            
            $componentsConfig['components']['urlManager'] = require $this->configDir .  'urlManager.php';            
            $commonConfig = $this->isDebug ? 
                    require $this->configDir . 'config-dev.php' : 
                require $this->configDir . 'config.php';             
        }
        return ArrayHelper::merge($baseConfig,$commonConfig, $componentsConfig, $paramsConfig);
    }
    
    private function paramsFileFullPath(): string 
    {
        return $this->configDir . $this->paramsFileName;
    }

    private function isParamsFileExist(): bool
    {
        return file_exists($this->paramsFileFullPath());
    }
}


