<?php

use app\core\helpers\View\User\UserStatusHelper;
use app\models\ActiveRecord\Users\User;
use app\models\ActiveRecord\Users\UserType;
use app\models\Forms\User\Manage\ActivateForm;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model User */
/* @var $modificationsProvider ActiveDataProvider */

$this->title = $model->login;

$attributes = [
                    'login:text:Login',
                    'fio:text:ФИО',
                    'email:text:Email',
                    'phone:text:Phone number',
                    'userType.name:text:User type',
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => UserStatusHelper::getStatusLabel($model->status)
                    ]
                ];
/*
switch ($model->user_type_id) {
    case UserType::MEMBER_USER_ID:
        $dopAttributes = [
            'profile.position:text:' . t('Position', 'user'),
            'profile.activities:text:' . t('Scope of the company','company'),
            'profile.proposal_signature_name:text:' . t('Signer\'s full name','company'),
            'profile.proposal_signature_post:text:' . t('Signer\'s position','company'),
        ];
        $attributes = ArrayHelper::merge($attributes, $dopAttributes);
        break;
}
 * 
 */
?>
<div class="full-view">
    <p>
        <?= Html::a('Change', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete the user?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                    <div class="card-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => $attributes,
                        ]); ?>
                    </div>
            </div>
        </div>
    </div>
</div>


