<?php

namespace app\core\repositories\readModels\User;

use app\core\repositories\readModels\ReadRepositoryInterface;
use app\models\ActiveRecord\Users\User;
use yii\db\ActiveRecordInterface;

/**
 * Description of UserReadRepository
 *
 * @author kotov
 */
class UserReadRepository implements ReadRepositoryInterface
{
    /**
     * 
     * @param type $id
     * @return ActiveRecordInterface|User|null
     */
    public static function findById($id): ?ActiveRecordInterface
    {
        return User::find()
                ->andWhere(['id' => $id])
                ->andWhere(['status' => [User::STATUS_ACTIVE,User::STATUS_NEW]])
                ->one();
    }
    
    public function findByUserName($value): ?User
    {
        return User::find()
                ->where(['active' => [User::STATUS_ACTIVE,User::STATUS_NEW]])
                ->andWhere(['login' => $value])              
                ->one();
    }
    
    public function findByEmail(string $email) : ?User
    {
        return User::find()
                ->where(['email' => $email])
                ->andWhere(['status' => [User::STATUS_ACTIVE,User::STATUS_NEW]])                
                ->one();        
    } 
    public function findByAuthKey($authKey): ?User
    {
        return User::find()
                ->where(['auth_key' => $authKey])
             //   ->andWhere(['deleted' => false])              
                ->one();
    }
    
    public function findByUserNameOrEmail($value): ?User
    {
        return User::find()
                ->where(['status' => [User::STATUS_ACTIVE, User::STATUS_NEW]])
                ->andWhere(['or',['login' => $value],['email' => $value]])
                ->one();
    }
}
