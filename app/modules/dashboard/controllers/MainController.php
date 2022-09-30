<?php

namespace app\modules\dashboard\controllers;

/**
 * Description of MainController
 *
 * @author kotov
 */
class MainController extends BaseAdminController
{
    public function actionIndex() 
    {
      /*  if (Yii::$app->user->isGuest) {  
            return $this->redirect('/authorization');
        }*/
        return $this->render('index');
    }
}
