<?php

use app\core\helpers\View\User\UserStatusHelper;
use app\models\Forms\Manage\Users\UserForm;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use kartik\form\ActiveForm;



/** @var View $this */
/** @var ActiveForm $form */
/** @var UserForm $model */
?>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">                           
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput() ?>
    <?= $form->field($model, 'email')->textInput(); ?>   
    <?= $form->field($model, 'fio')->textInput(); ?>   
    <?= $form->field($model, 'phone')->textInput(); ?>   
    <?= $form->field($model, 'userType')->dropDownList($model->userTypeList()) ?>
    <?= $form->field($model, 'status')->dropDownList(UserStatusHelper::statusList()) ?>
    <?= $form->field($model, 'birthday')->widget(DatePicker::class, [
           'options' => ['placeholder' => ''],
            'value' => $model->birthday,
            'removeButton' => false,
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,        
           'pluginOptions' => [
               'autoclose'=>true,
               'format' => 'dd.mm.yyyy'
           ]
       ]); ?>
    <?= $form->field($model, 'description')->textarea(); ?>                             
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>                           
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel',['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
