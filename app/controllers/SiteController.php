<?php

namespace app\controllers;

use app\controllers\actions\UserManagement\ActivateAction;
use app\controllers\actions\UserManagement\CabinetAction;
use app\controllers\actions\UserManagement\InviteAction;
use app\controllers\actions\UserManagement\LoginAction;
use app\controllers\actions\UserManagement\SignupAction;
use app\models\ActiveRecord\Users\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use function is_guest;

/**
 * Description of SiteController
 *
 * @author kotov
 */
class SiteController extends Controller
{
    public function actions(): array
    {
        return [
            'signup' => SignupAction::class,
            'login' => LoginAction::class,
            'activate' => ActivateAction::class,
            'invite' => InviteAction::class,
            'lk' => CabinetAction::class
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Can Want! - Главная страница';
        return $this->render('index');
    }    
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->render('index');
    }    
}
