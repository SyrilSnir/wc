<?php

namespace app\commands\controllers;

use app\models\ActiveRecord\Users\User;
use app\models\ActiveRecord\Users\UserType;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Description of AdminController
 *
 * @author kotov
 */
class AdminController extends Controller
{
    public function actionTest()
    {        
        $this->stdout('Test', Console::FG_YELLOW);
    }
    
    public function actionCreateAdmin()
    {
        while (true) {
            Console::output('Задайте пароль: ');
            $password = Console::stdin();
            Console::output('Повторите пароль: ');
            $passwordRepeat = Console::stdin();
            if ($password === $passwordRepeat) {
                break;
            }
            Console::output("Введенные пароли не совпадают");
            
        }
        $isAdminExist = !empty(User::findOne(['login' => 'admin']));
        if ($isAdminExist) {
            Console::output('Пользователь с правами администратора уже был создан');
            return ExitCode::OK; 
        }
        $admin = User::create(
                'admin','admin@wc.local', 
                UserType::ADMIN_USER_ID, 
                User::STATUS_ACTIVE                
                );
        $admin->setPassword($password);
        $admin->save();
        $auth = Yii::$app->authManager;        
        $adminRole = $auth->getRole(UserType::ADMIN_USER_TYPE);        
        $auth->assign($adminRole, $admin->id);         
        return ExitCode::OK;
    }

    /**
     * Первоначаьная установка ролей для пользователей
     */
    public function actionSetUserRoles()
    {

        $auth = Yii::$app->authManager;
        $auth->removeAllAssignments();
        $adminRole = $auth->getRole(UserType::ADMIN_USER_TYPE);
        $standartUserRole = $auth->getRole(UserType::STANDART_USER_TYPE);       
        $users = User::find()->all();
        
        foreach ($users as $user)
        {
            /* @var $user User */
            switch ($user->user_type_id) {
                case UserType::ADMIN_USER_ID:
                    Console::output("Установлена роль 'Администратор' для пользователя {$user->login}");
                    $auth->assign($adminRole, $user->id);                   
                    break;
                case UserType::STANDART_USER_ID:
                    $auth->assign($standartUserRole, $user->id);
                     Console::output("Установлена роль 'Участник' для пользователя {$user->login}");
                    break;
            }
        }
        return ExitCode::OK;        
    }    
/**
 * Обновление ролей
 */
    public function actionRenewUserTypes() 
    {
        chdir(__DIR__);
        $items = require './../fixtures/user/user.types.php';
        foreach ($items as $item) {
            $currentModel = UserType::findOne(['id' => $item['id']]);
            if (!$currentModel) {
                $model = new UserType();
                $model->setAttributes($item,false);
                $model->save(false);
                unset($model);
            }
        }         
    }
    
    public function actionSetData()
    {
        UserType::deleteAll(); 
        $this->addData(UserType::class, './../fixtures/user/user.types.php');                 
    }

    protected function addData($className,$fixture)
    {
        chdir(__DIR__);
        $items = require $fixture;
        foreach ($items as $item) {
            $model = new $className();
            $model->setAttributes($item,false);
            $model->save(false);
            unset($model);
        }                    
    }    
}
