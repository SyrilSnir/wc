<?php

namespace app\controllers\actions\UserManagement;

use app\core\repositories\readModels\User\UserReadRepository;
use app\core\services\auth\AuthService;
use app\core\services\auth\UserIdentity;
use Yii;
use yii\base\Action;
use yii\helpers\StringHelper;

/**
 * Description of ActivateAction
 *
 * @author kotov
 */
class ActivateAction extends Action
{
    /**
     * 
     * @var AuthService
     * 
     */
    private $authService;
    
    /**
     * 
     * @var type
     */
    private $usersRepository;
    
    public function __construct($id, 
            $controller, 
            AuthService $authService,
            UserReadRepository $usersRepository,
            $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->authService = $authService;
        $this->usersRepository = $usersRepository;
    }
    
    public function run(string $token) 
    {
        $authKey = StringHelper::base64UrlDecode($token);
        $user = $this->usersRepository->findByAuthKey($authKey);
        if (!$user) {
            return  $authKey;
        }
        
        if (!Yii::$app->user->isGuest) {            
            Yii::$app->user->logout();
        }
        $this->authService->activateUser($user);
        Yii::$app->user->login(new UserIdentity($user));
        Yii::$app->session->setFlash('info', "Поздравляем,Ваша учетная запись {$user->login} успешно активирована");
        return $this->controller->render('index');
    }
}
