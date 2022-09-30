<?php

namespace app\core\repositories\readModels;

use yii\db\ActiveRecordInterface;

/**
 *
 * @author kotov
 */
interface ReadRepositoryInterface
{
    /**
     * 
     * @param type $id
     * @return ActiveRecordInterface|null
     */
    public static function findById($id): ?ActiveRecordInterface;
}
