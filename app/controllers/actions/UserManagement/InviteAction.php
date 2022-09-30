<?php

namespace app\controllers\actions\UserManagement;

use app\core\repositories\readModels\User\UserReadRepository;
use app\core\services\auth\SignupService;
use app\models\ActiveRecord\Users\User;
use yii\base\Action;

/**
 * Description of InviteAction
 *
 * @author kotov
 */
class InviteAction extends Action
{
    
    /**
     * 
     * @var SignupService
     */
    private $signupService;
    
    /**
     * 
     * @var UserReadRepository
     */
    private $userRepository;
    
    public function __construct(
            $id, 
            $controller, 
            SignupService $signupService,
            UserReadRepository $userRepository,
            $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->signupService = $signupService;
        $this->userRepository = $userRepository;
    }
    
    public function run(int $id)
    {
        $user = $this->userRepository->findById($id);
        if ($user && $user->status == User::STATUS_NEW) {
           // $this->signupService->sendInviteNotificationMail($user);
            \Yii::$app->session->setFlash('info',"Ссылка для активации отправлена на адрес {$user->email}!" );
        } else {
            \Yii::$app->session->setFlash('warning','Активация для данного пользователя невозможна');
        }
        return $this->controller->goHome();
    }
}
