<?php

namespace app\models\ActiveRecord\Users;

use app\core\traits\ActiveRecord\MultilangTrait;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_types}}".
 *
 * @property int $id
 * @property string $name Название типа пользователя
 * @property string $slug Идентификатор типа пользователя
 *
 * @property User[] $users
 */
class UserType extends ActiveRecord
{
    /**
     * ID для типа учетной записи "Суперпользователь"
     */
    const ADMIN_USER_ID = 1;
    
    /**
     * Роль администратор
     */
    const ADMIN_USER_TYPE = 'admin';
    
    /**
     * Роль обычного пользователя
     */
    const STANDART_USER_TYPE = 'standart';
    
    const STANDART_USER_ID = 2;   
    
    const ROLES = [
        self::ADMIN_USER_ID => self::ADMIN_USER_TYPE,
        self::STANDART_USER_ID => self::STANDART_USER_TYPE,
    ];    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_types}}';
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_type_id' => 'id']);
    }           
}
