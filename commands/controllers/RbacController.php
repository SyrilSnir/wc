<?php

namespace app\commands\controllers;

use app\core\services\auth\Rbac;
use app\models\ActiveRecord\Users\UserType;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Управление ролями пользователей 
 *
 * @author kotov
 */
class RbacController extends Controller
{
    /**
     * Установка ролей
     */
    public function actionInit()
    {        
        $auth = Yii::$app->authManager;
        $auth->removeAll();
               
        $admin = $auth->createRole(UserType::ADMIN_USER_TYPE);
        $admin->description = 'Администратор';
        $auth->add($admin);
        
        $baseUser = $auth->createRole(UserType::STANDART_USER_TYPE);
        $baseUser->description = 'Роль обычного пользователя';
        $auth->add($baseUser);    
        
        $adminDashboard = $auth->createPermission(Rbac::PERMISSION_ADMIN_DASHBOARD);
        $adminDashboard->description ='Панель администратора';
        $auth->add($adminDashboard);
        $auth->addChild($admin, $adminDashboard);
        
        Console::output('Роли установлены');
    }
}