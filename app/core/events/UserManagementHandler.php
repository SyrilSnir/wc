<?php


namespace app\core\events;

use app\core\services\auth\RoleManager;
use app\models\ActiveRecord\Users\User;
use app\models\ActiveRecord\Users\UserType;
use Yii;
use yii\base\Event;

/**
 * Description of UserManagementHandler
 *
 * @author kotov
 */
class UserManagementHandler
{   
    public static function setRoles(Event $event) 
    {
        /** @var RoleManager $roleManager */
        $roleManager = Yii::$container->get(RoleManager::class);
        /** @var User $user */
        $user = $event->sender;
        $roleManager->revokeRoles($user->id);
        $roleManager->setRole(UserType::ROLES[$user->user_type_id], $user->id);                        
    }
}
