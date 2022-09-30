<?php

namespace app\modules\dashboard\controllers\actions\config;

use app\core\helpers\Data\ConfigurationHelper;
use app\core\services\operations\SettingsService;
use app\models\ActiveRecord\Configuration;
use app\models\Forms\Manage\Configuration\MailConfigurationForm;
use Yii;
use yii\base\Action;

/**
 * Description of MailAction
 *
 * @author kotov
 */
class MailAction extends Action
{
    /**
     * 
     * @var SettingsService
     */
    protected $settingsService;
    
    
    public function __construct(
            $id, 
            $controller, 
            SettingsService $settingsService,
            $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->settingsService = $settingsService;
    }
    
    public function run()
    {
        $form = new MailConfigurationForm();
        $config = ConfigurationHelper::getConfig(Configuration::SMTP_SETTINGS_SECTION); 
        if ($config) {
            $form->setAttributes($config);
        }
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->settingsService->saveConfiguration($form, Configuration::SMTP_SETTINGS_SECTION);
            Yii::$app->session->setFlash('configurationSaved', 'Конфигурация успешно сохранена');
        }        
        return $this->controller->render('mail',[
            'model' => $form
        ]);
    }
}
