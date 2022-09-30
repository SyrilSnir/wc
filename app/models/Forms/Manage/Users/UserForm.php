<?php

namespace app\models\Forms\Manage\Users;

use app\core\helpers\Utils\DateHelper;
use app\core\traits\Lists\GetUserTypeListTrait;
use app\models\ActiveRecord\Users\User;
use app\models\Forms\Manage\ManageForm;

/**
 * Description of UserForm
 *
 * @author kotov
 */
class UserForm extends ManageForm
{
    private $_id;
    
    public $login;
    public $email;
    public $fio;
    public $birthday;
    public $status;
    public $phone;
    public $description;
    public $userType;
    public $password;
    public $passwordRepeat;
    
    use GetUserTypeListTrait;

    public function __construct(User $model = null, $config = [])
    {
        parent::__construct($config);
        if ($model) {
            $this->_id = $model->id;
            $this->login = $model->login;
            $this->email = $model->email;
            $this->fio = $model->fio; 
            $this->status = $model->status;
            $this->phone = $model->phone;
            $this->description = $model->description;
            $this->userType = $model->user_type_id;           
            if ($model->birthday) {
                $this->birthday = DateHelper::timestampToDate($model->birthday);
            }
        }
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           ['passwordRepeat','compare', 'compareAttribute' => 'password','message' => 'Введенные пароли не совпадают'],            
            [['login','email'], 'required','message' => 'Поле не может быть пустым'],
            [['birthday'], 'safe'],
            [['password','passwordRepeat'], 'required', 'on' => self::SCENARIO_CREATE],
            [['email'], 'email'],
            [['status', 'userType'], 'number'],
            [['description'], 'string'],
            [['login', 'fio',  'phone'], 'string', 'max' => 255],
            [
                ['login','email'],
                'unique',
                'targetClass'=> User::class,
                'filter' => ['deleted' => false],
                'message' => 'Пользователь с такими данными уже зарегистрирован',
                'on' => self::SCENARIO_CREATE
            ],
            [
                ['login','email'],
                'unique',
                'targetClass'=> User::class,
                'filter' => function(\yii\db\Query $query) {
                    return $query->andWhere(['deleted' => false])
                            ->andWhere(['!=', 'login', $this->login]);
                },
                'message' => 'Пользователь с такими данными уже зарегистрирован',
                'on' => self::SCENARIO_UPDATE
            ],            
        ];
    }
    public function attributeLabels(): array
    {
        return [
            'login' => 'Логин',
            'email' => 'E-mail',
            'fio' => 'ФИО',
            'phone' => 'Телефонный номер',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повторите пароль',
            'birthday' => 'Дата рождения',
            'description' => 'Дополнительная информация',
            'userType' => 'Тип учетной записи',
            'status' => 'Статус'
        ];
    }
}
