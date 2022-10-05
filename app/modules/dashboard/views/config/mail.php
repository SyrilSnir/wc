<?php

use app\models\Forms\Manage\Configuration\MailConfigurationForm;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;
use kartik\form\ActiveForm;
/* @var $this View */
/** @var MailConfigurationForm $model  */
$this->title = 'Настройки почты';
?>

<div class="mail-settings-form update-form">
<?php if (Yii::$app->session->has('configurationSaved')): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo Yii::$app->session->getFlash('configurationSaved') ?>
    </div>
<?php endif; ?>    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false
    ]); ?>
                            
    <?= $form->field($model, 'mailServerIsEnabled')->widget(SwitchInput::class,[
        'pluginOptions' => [
                'onText' => 'Да',
                'offText' => 'Нет',
            ],
        'pluginEvents' => [
            "switchChange.bootstrapSwitch" => 
                "function(e) { 
                    e.target.checked ? $('#mail-params__container').removeClass('hide') :
                    $('#mail-params__container').addClass('hide'); 
                    
            }",
        ]         
    ]) ?>      
                            <div id="mail-params__container"<?php if (!$model->mailServerIsEnabled): ?>class="hide"<?php endif; ?>>
                                
    <?= $form->field($model, 'smtpServer')->textInput() ?>      
    <?= $form->field($model, 'smtpPort')->textInput() ?> 

    <?= $form->field($model, 'tls')->widget(SwitchInput::class,[
        'pluginOptions' => [
                'onText' => 'Да',
                'offText' => 'Нет',
            ]
    ]) ?>                            
    <?= $form->field($model, 'userName')->textInput() ?>      
    <?= $form->field($model, 'password')->passwordInput() ?>  
                            <br>
    <?= $form->field($model, 'senderName')->textInput() ?>                         
    <?= $form->field($model, 'senderEmail')->textInput() ?>                         
                            
</div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

