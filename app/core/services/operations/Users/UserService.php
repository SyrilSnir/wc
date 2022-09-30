<?php

namespace app\core\services\operations\Users;

use app\core\repositories\manage\Users\UserRepository;
use app\core\services\operations\Operations;

/**
 * Description of UserService
 *
 * @author kotov
 */
class UserService extends Operations
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
