<?php

namespace app\controllers\actions\UserManagement;

use app\core\services\auth\SignupService;
use app\models\Forms\User\SignupForm;
use Yii;
use yii\base\Action;

/**
 * Description of SignUpAction
 *
 * @author kotov
 */
class SignupAction extends Action
{
    /**
     * 
     * @var SignupService
     */
    private $signupService;
    
    public function __construct(
            $id, 
            $controller, 
            SignupService $signupService,
            $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->signupService = $signupService;
    }
    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        } 
            
        $signupForm = new SignupForm();
        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->validate()) {
            $user = $this->signupService->signup($signupForm);
            \Yii::$app->session->setFlash('info',"Ссылка для активации отправлена на адрес {$user->email}!" );
            return $this->controller->goHome();
        }
        return $this->controller->render('signup',[
            'model' => $signupForm
        ]);            
    }
}
