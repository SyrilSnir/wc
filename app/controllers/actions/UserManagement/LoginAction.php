<?php

namespace app\controllers\actions\UserManagement;

use app\core\exceptions\PasswordVerifyException;
use app\core\services\auth\AuthService;
use app\core\services\auth\UserIdentity;
use app\models\Forms\User\LoginForm;
use Yii;
use yii\base\Action;

/**
 * Description of LoginAction
 *
 * @author kotov
 */
class LoginAction extends Action
{
    /**
     * 
     * @var AuthService
     * 
     */
    private $authService;
    
    public function __construct($id, 
            $controller, 
            AuthService $authService,
            $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->authService = $authService;
    }
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        } 
            
        $loginForm = new LoginForm();
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate()) {
            try {
                $user = $this->authService->authByPassword($loginForm);
                Yii::$app->user->login(new UserIdentity($user));
                return $this->controller->goHome();    
                
            } catch (PasswordVerifyException $e) {
                $loginForm->addError('password', $e->getMessage());
            }
        }
        return $this->controller->render('login',[
            'model' => $loginForm
        ]);
    }
}