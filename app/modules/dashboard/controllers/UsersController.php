<?php

namespace app\modules\dashboard\controllers;

use app\core\repositories\readModels\User\UserReadRepository;
use app\core\services\operations\Users\UserService;
use app\core\traits\GridViewTrait;
use app\models\Forms\Manage\Users\UserForm;
use app\models\SearchModels\Users\UserSearch;

/**
 * Description of UsersController
 *
 * @author kotov
 */
class UsersController extends CrudController
{
    use GridViewTrait;
    
    public function __construct($id, 
            $module, 
            UserService $service,
            UserSearch $searchModel,
            UserReadRepository $repository,
            UserForm $form,
            $config = [])
    {
        parent::__construct($id, $module,$service,$repository,$form, $config);
        $this->searchModel = $searchModel;
    }
    
}
