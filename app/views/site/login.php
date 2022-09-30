<?php

/** @var View $this */
/** @var ActiveForm $form */
/** @var LoginForm $model */

use app\models\Forms\User\LoginForm;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap5\ActiveForm;

$this->title = 'Войти в систему';
?>
<div class="site-login container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для входа заполните следующие поля:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>

