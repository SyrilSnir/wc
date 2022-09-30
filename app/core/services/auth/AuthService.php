<?php

namespace app\core\services\auth;

use app\core\exceptions\PasswordVerifyException;
use app\core\repositories\readModels\User\UserReadRepository;
use app\models\ActiveRecord\Users\User;
use app\models\Forms\User\LoginForm;
use Yii;
use yii\base\InvalidArgumentException;

/**
 * Description of AuthService
 *
 * @author kotov
 */
class AuthService
{
    /**
     *
     * @var UserReadRepository
     */
    public $userReadRepository;
    
    public function __construct(UserReadRepository $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }

    
    public function authByPassword(LoginForm $loginForm): User
    {
        $user = $this->userReadRepository->findByUserNameOrEmail($loginForm->login);
        if ($user) {
            try {
                if(Yii::$app->security->validatePassword($loginForm->password, $user->password_hash)) {
                    return $user;
                }
            } catch (InvalidArgumentException $e) {

            } 
        }
        throw new PasswordVerifyException('Неверный логин или пароль');
    }
    
    public function activateUser(User $user):User
    {
        $user->activate();
        $user->save();
        return $user;
    }
}
