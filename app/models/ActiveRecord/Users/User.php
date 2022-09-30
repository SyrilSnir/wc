<?php

namespace app\models\ActiveRecord\Users;

use app\models\ActiveRecord\ManagedModelInterface;
use app\models\Forms\Manage\ManageForm;
use app\models\Forms\Manage\Users\UserForm;
use app\models\Forms\User\SignupForm;
use app\models\TimestampTrait;
use DateTime;
use DomainException;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $login
 * @property string|null $auth_key
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $fio ФИО
 * @property string $email Электронная почта
 * @property string|null $phone Номер телефона
 * @property string|null $birthday Дата рождения
 * @property string|null $avatar Путь к файлу с аватаром
 * @property string|null $description Дополнительная информация
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $user_type_id Тип пользоателя
 * @property int $deleted
 */
class User extends ActiveRecord implements ManagedModelInterface
{
    const STATUS_NEW = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;    
    /**
     * {@inheritdoc}
     */
    
    use TimestampTrait;
    
    public static function tableName()
    {
        return '{{%users}}';
    }
    
    public static function create(
            string $login,
            string $email,
            int $userType,
            int $status,
            string $fio = '',
            int $birthday = null,
            string $phone = '',
            string $description = ''
            
    ): self
    {
        $user = new self();
        $user->login = $login;
        $user->email = $email;
        $user->status = $status;
        $user->user_type_id = $userType;
        $user->fio = $fio;
        $user->phone = $phone;
        $user->birthday = $birthday;
        $user->description = $description; 
        return $user;
    }

    /**
     * 
     * @param UserForm $form
     * @return self
     */
    public static function createWithForm(ManageForm $form) : static
    {
        $birthday = null;
        if ($form->birthday) {
            $birthday = DateTime::createFromFormat('d.m.Y',$form->birthday)->getTimestamp();
        }
        $user = new self();
        $user->login = $form->login;
        $user->email = $form->email;
        $user->status = $form->status;
        $user->user_type_id = $form->userType;
        $user->fio = $form->fio;
        $user->phone = $form->phone;
        $user->birthday = $birthday;
        $user->description = $form->description;
        if ($form->password) {
            return $user->setPassword($form->password)->setAuthKey();
        }
        return $user;        
    }

    public static function signup(SignupForm $form) : self
    {
        $birthday = null;
        if ($form->birthday) {
            $birthday = DateTime::createFromFormat('d.m.Y',$form->birthday)->getTimestamp();
        }
        $user = self::create(
                $form->login,
                $form->email,
                UserType::STANDART_USER_ID,
                self::STATUS_NEW,
                $form->fio,
                $birthday,
                $form->phone,
                $form->description
        );
        return $user->setPassword($form->password)->setAuthKey();
        
    }
    
    /**
     * 
     * @param UserForm $form
     * @return \self
     */
    public function edit(ManageForm $form): void
    {
        $birthday = null;
        if ($form->birthday) {
            $birthday = DateTime::createFromFormat('d.m.Y',$form->birthday)->getTimestamp();
        }
        $this->login = $form->login;
        $this->email = $form->email;
        $this->status = $form->status;
        $this->user_type_id = $form->userType;
        $this->fio = $form->fio;
        $this->phone = $form->phone;
        $this->birthday = $birthday;
        $this->description = $form->description;
        if ($form->password) {
            $this->setPassword($form->password)->setAuthKey();
        }         
    }


    public function setAuthKey(): self
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
        return $this;
    }
    
    public function resetAuthKey(): self
    {
        $this->auth_key = null;
        return $this;
    }
    
    public function setPassword(string $password) :self
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        return $this;
    }
    
    public function activate(): self
    {
        if (!$this->status === self::STATUS_NEW)
        {
            throw new DomainException('Активация возможна только для новой учетной записи');
        }
        $this->status = self::STATUS_ACTIVE;
        return $this;
    }
    
    public function getUserType()
    {
        return $this->hasOne(UserType::class, ['id' => 'user_type_id']);
    }    
}
