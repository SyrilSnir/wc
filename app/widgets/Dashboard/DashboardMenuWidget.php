<?php

namespace app\widgets\Dashboard;

use yii\base\Widget;

/**
 * Description of DashboardMenuWidget
 *
 * @author kotov
 */
class DashboardMenuWidget extends Widget
{
    public $items = [];
    
    public function run() 
    {
        return $this->render('menu',[
            'items' => $this->items
        ]);
    }
            
}
