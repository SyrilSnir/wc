<?php

namespace app\core\repositories\manage\Users;

use app\core\repositories\exceptions\NotFoundException;
use app\core\repositories\manage\DataManipulationTrait;
use app\core\repositories\manage\ManagedRepositoryInterface;
use app\models\ActiveRecord\ManagedModelInterface;
use app\models\ActiveRecord\Users\User;

/**
 * Description of UserRepository
 *
 * @author kotov
 */
class UserRepository implements ManagedRepositoryInterface
{
    use DataManipulationTrait;
    
    
    public function get(int $id): ManagedModelInterface
    {
        if (!$model = User::findOne($id)) {
            throw new NotFoundException('Пользователь не найден');
        }
        return $model;
    }
    
    public function getByAuthKey(string $authKey): User
    {
        if (!$model = User::findOne(['auth_key' => $authKey, 'deleted' => false])) {
            throw new NotFoundException('Пользователь не найден');
        }
        return $model;        
    }

    public function modelName(): string
    {
        return User::class;
    }

}
