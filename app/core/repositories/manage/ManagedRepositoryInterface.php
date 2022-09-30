<?php

namespace app\core\repositories\manage;

use app\models\ActiveRecord\ManagedModelInterface;
use yii\db\ActiveRecord;

/**
 *
 * @author kotov
 */
interface ManagedRepositoryInterface
{
    public function get(int $id) : ManagedModelInterface;
    public function save(ActiveRecord $model) ;
    public function remove(ActiveRecord $model);     
    public function modelName(): string;   
}
