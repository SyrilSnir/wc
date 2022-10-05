<?php

namespace app\models\Forms\Manage\Configuration;

use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Description of SmtpConfigurationForm
 *
 * @author kotov
 */
class MailConfigurationForm extends Model implements ConfigurationFormInterface
{        
    /**
     * 
     * @var bool
     */
    public $mailServerIsEnabled = false;
    /**
     *
     * @var string
     */
    public $smtpServer;
    
    /**
     *
     * @var int
     */
    public $smtpPort;
    /**
     *
     * @var string
     */
    public $userName;
    
    /**
     *
     * @var string
     */
    public $password;
    /**
     *
     * @var bool
     */
    public $tls;
    
    /**
     *
     * @var string
     */
    public $senderName;
    
    /**
     *
     * @var null|string
     */
    public $senderEmail;
    
    const SCENARIO_NO_MAIL = 'no_mail';
    
    public function rules(): array
    {
        return [
            [['smtpServer', 'smtpPort', 'userName', 'password','senderEmail'], 'required'],
            [['smtpPort'],'integer'],
            [['senderName'],'safe'],
            [['mailServerIsEnabled'],'boolean'],
            [['tls'],'boolean']
        ];
    }
    
    public function scenarios()
    {
        return ArrayHelper::merge([
            self::SCENARIO_NO_MAIL => [
                'mailServerIsEnabled'
            ]
        ], parent::scenarios());
    }


    public function attributeLabels(): array
    {
        return [
            'mailServerIsEnabled' => 'Использовать почтовый сервер',
            'smtpServer' => 'Почтовый сервер',
            'smtpPort' => 'SMTP порт',
            'tls' => 'Использовать соединение (TLS)',
            'userName' => 'Логин',
            'password' => 'Пароль',
            'senderName' => 'Имя отправителя',
            'senderEmail' => 'Email отправителя',
        ];
    }
}
