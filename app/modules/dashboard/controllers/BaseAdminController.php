<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\modules\dashboard\controllers;

use app\core\services\auth\Rbac;
use Yii;
use yii\base\Action;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Description of BaseAdminController
 *
 * @author kotov
 */
abstract class BaseAdminController extends Controller
{         
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_ADMIN_DASHBOARD]
                    ]  
                ],
                'denyCallback' => function($rule, Action $action) {
                    /** @var Action $action */
                        if (!Yii::$app->user->isGuest) {
                            Yii::$app->session->setFlash('warning','Недостаточно прав для доступа к панели управления');
                        }
                        return $action->controller->goHome();
                },
            ]
        ];
    }
    
}
