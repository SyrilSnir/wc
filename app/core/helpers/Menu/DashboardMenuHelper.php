<?php

namespace app\core\helpers\Menu;

/**
 * Description of DashboardMenuHelper
 *
 * @author kotov
 */
class DashboardMenuHelper extends MenuHelper implements MenuHelperInterface
{   
    public function getMenu(): array
    {
        $menuItems = [
        ];
        
        $menuItems = [
            [
                'label' => 'Пользователи',
                'icon' => 'user', 
                'url' => ['/dashboard/users']
            ],
            [
                'label' => 'Конфигурация',
                'icon' => 'gear', 
                //'url' => ['/dashboard/config']
                'items' => [
                    [
                        'label' => 'Почтовый сервер',
                        'icon' => 'mail',       
                        'url' => ['/dashboard/mail']
                    ]
                ]
            ]
        ];

        return $menuItems;
    }
}
