<?php

namespace app\core\helpers\Menu;

use yii\helpers\Html;

/**
 * Description of NavMenuHelper
 *
 * @author kotov
 */
class NavMenuHelper extends MenuHelper implements MenuHelperInterface
{     
    public function getMenu(): array
    {
        $menuItems = [
        ];
        if ($this->user->isGuest) {
            $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        } else {
            $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/site/lk']];
            $menuItems[] = '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . $this->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>';
        }
        return $menuItems;
    }
}
