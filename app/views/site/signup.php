<?php

use app\models\Forms\User\SignupForm;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\ActiveForm;

/** @var View $this */
/** @var ActiveForm $form */
/** @var SignupForm $model */

$this->title = 'Регистрация';

?>
<div class="site-signup container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для регистрации на портале заполните форму:</p>
    
    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'validateOnBlur' => false
    ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'fio')->textInput() ?>
        <?= $form->field($model, 'phone')->textInput() ?>
    <?php 
        echo $form->field($model, 'birthday')->widget(DatePicker::class, [
           'options' => ['placeholder' => 'Дата рождения'],
            'value' => $model->birthday,
            'removeButton' => false,
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
               'autoclose'=>true,
               'format' => 'dd.mm.yyyy'
           ]
       ]);    
        echo $form->field($model, 'description')->textarea();   
    ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
    
</div>
