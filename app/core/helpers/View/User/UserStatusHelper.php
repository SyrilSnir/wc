<?php

namespace app\core\helpers\View\User;

use app\core\helpers\View\StatusHelper;
use app\models\ActiveRecord\Users\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Description of UserStatusHelper
 *
 * @author kotov
 */
class UserStatusHelper extends StatusHelper
{

    public static function getStatusLabel(string $status):string
    {
        switch ($status) {
            case User::STATUS_ACTIVE:
                $className = 'badge bg-success';
                break;
            default:
                $className = 'badge bg-warning';
                break;
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $className,
        ]);        
    }

    public static function statusList(): array
    {
        return [
            User::STATUS_NEW => 'Новый',
            User::STATUS_ACTIVE => 'Активирован',
            User::STATUS_BLOCKED => 'Заблокирован',
        ];
    }

}
