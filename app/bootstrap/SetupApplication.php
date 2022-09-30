<?php

namespace app\bootstrap;

use app\core\events\UserManagementHandler;
use app\core\helpers\Data\ConfigurationHelper;
use app\core\helpers\Menu\DashboardMenuHelper;
use app\core\helpers\Menu\NavMenuHelper;
use app\core\services\auth\RoleManager;
use app\core\services\mail\MailService;
use app\models\ActiveRecord\Configuration;
use app\models\ActiveRecord\Users\User;
use app\models\Configuration\MailParameters;
use app\models\Forms\Manage\Configuration\MailConfigurationForm;
use Swift_SmtpTransport;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\swiftmailer\Mailer;

/**
 * Description of SetupApplication
 *
 * @author kotov
 */
class SetupApplication implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;
        $container->set(NavMenuHelper::class,[
            'user' => $app->user
        ]);
        $container->set(DashboardMenuHelper::class,[
            'user' => $app->user
        ]);
        $container->set(RoleManager::class, function($container, $params, $args){
            return new RoleManager(Yii::$app->authManager);
        });        
        $container->setSingleton(MailService::class,function($container, $params, $args){
            $mailConfig = ConfigurationHelper::getConfig(Configuration::SMTP_SETTINGS_SECTION);
            $form = new MailConfigurationForm();
            $form->setAttributes($mailConfig);
            $smtp = true;
            if (!$form->validate()) {
                
                $mailConfig = key_exists('mailSettings', Yii::$app->params) ? Yii::$app->params['mailSettings'] : [];
                $form->setAttributes($mailConfig);
                if (!$form->validate()) {
                    $smtp = false;
                }
            } 
            /** @var Mailer $mailer */
            $mailer = new Mailer(); 
            $mailer->setViewPath('@mail');
            if ($smtp) {
                $smtpParams = MailParameters::create(
                    $form->smtpServer, 
                    $form->smtpPort, 
                    $form->userName,
                    $form->password,
                    $form->senderEmail,
                    $form->senderName,
                    $form->tls ?? false
                    );
                $transport = (new Swift_SmtpTransport(
                    $smtpParams->smtpServer,
                    $smtpParams->smtpPort))
                        ->setUsername($smtpParams->userName)
                        ->setPassword($smtpParams->password);
                $mailer->setTransport($transport);
                $mailer->useFileTransport = false;
                return new MailService($mailer, $smtpParams->senderEmail,$smtpParams->senderName,$smtpParams);
            }
            $mailer->useFileTransport = true;
            return new MailService($mailer, 'test@test.ru','test');
        });
        Event::on(User::class, ActiveRecord::EVENT_AFTER_INSERT, [UserManagementHandler::class,'setRoles']);
        Event::on(User::class, ActiveRecord::EVENT_AFTER_UPDATE, [UserManagementHandler::class,'setRoles']);
    }

}
