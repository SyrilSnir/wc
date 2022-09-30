<?php

namespace app\models\ActiveRecord;

use app\models\Forms\Manage\ManageForm;

/**
 *
 * @author kotov
 */
interface ManagedModelInterface
{
    public static function createWithForm(ManageForm $form) : static;
    
    public function edit(ManageForm $userForm): void;
}
