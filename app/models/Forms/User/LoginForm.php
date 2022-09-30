<?php

namespace app\models\Forms\User;

use yii\base\Model;

/**
 * Description of LoginForm
 *
 * @author kotov
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    
    public function rules(): array
    {
        return [
            [['login','password'],'required'],            
        ];
    }
    
    public function attributeLabels(): array
    {
        return [
            'login' => 'Логин или Email',
            'password' => 'Пароль'
        ];
    }
}
