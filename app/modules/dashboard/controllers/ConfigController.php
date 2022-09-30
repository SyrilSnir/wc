<?php

namespace app\modules\dashboard\controllers;

use app\modules\dashboard\controllers\actions\config\MailAction;

/**
 * Description of ConfigController
 *
 * @author kotov
 */
class ConfigController extends BaseAdminController
{    
    public function actions(): array
    {
        return [
            'mail' => MailAction::class
        ];
    }
}
