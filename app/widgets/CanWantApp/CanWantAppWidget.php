<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace app\widgets\CanWantApp;

use app\models\ActiveRecord\Users\User;
use Yii;
use yii\base\Widget;

/**
 * Description of CanWantAppWidget
 *
 * @author kotov
 */
class CanWantAppWidget extends Widget
{
    /**
     * 
     * @var ?User
     */
    private $user;
    
    public function init()
    {
        if (Yii::$app->user->isGuest) {
            $this->user = null;
        } else {
            $this->user = Yii::$app->user->getIdentity()->getUser();
        }
        parent::init();
    }    
    public function run()
    {
        
        return $this->render('index',[
            'enabled' => $this->isAppEnabled(),
            'isGuest' => Yii::$app->user->isGuest,
            'user' => $this->user
        ]);
    }
    
    private function isAppEnabled() : bool
    {
        return (!Yii::$app->user->isGuest && 
                (Yii::$app->user->getIdentity()->getUser()->status === User::STATUS_ACTIVE) );
    } 
}
