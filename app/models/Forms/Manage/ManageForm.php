<?php

namespace app\models\Forms\Manage;

use yii\base\Model;

/**
 * Description of ManageForm
 *
 * @author kotov
 */
abstract class ManageForm extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    
    public static function createWithModel(Model $model)
    {
        return new static($model);
    }
}
