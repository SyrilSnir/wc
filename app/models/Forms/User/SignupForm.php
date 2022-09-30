<?php

namespace app\models\Forms\User;

use app\models\ActiveRecord\Users\User;
use yii\base\Model;

/**
 * Description of SignupForm
 *
 * @author kotov
 */
class SignupForm extends Model
{
    public $login;
    public $fio;
    public $birthday;
    public $email;
    public $phone;
    public $description;
    public $password;
    public $passwordRepeat;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           ['passwordRepeat','compare', 'compareAttribute' => 'password','message' => 'Введенные пароли не совпадают'],            
            [['login','email','password','passwordRepeat'], 'required','message' => 'Поле не может быть пустым'],
            [['birthday'], 'safe'],
            [['email'], 'email'],
            [['description'], 'string'],
            [['login', 'fio',  'phone'], 'string', 'max' => 255],
            [
                ['login','email'],
                'unique',
                'targetClass'=> User::class,
                'filter' => ['deleted' => false],
                'message' => 'Пользователь с такими данными уже зарегистрирован',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'email' => 'E-mail',
            'fio' => 'ФИО',
            'phone' => 'Телефонный номер',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повторите пароль',
            'birthday' => 'Дата рождения',
            'description' => 'Дополнительная информация'
        ];
    }
}
