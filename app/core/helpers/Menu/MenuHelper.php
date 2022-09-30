<?php

namespace app\core\helpers\Menu;

use yii\base\Component;
use yii\web\User;

/**
 * Description of MenuHelper
 *
 * @author kotov
 */
abstract class MenuHelper extends Component implements MenuHelperInterface
{
    /**
     * 
     * @var User
     */
    private $user;
    
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }    
}
