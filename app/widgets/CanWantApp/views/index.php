<?php

use app\models\ActiveRecord\Users\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/** @var bool $enabled */
/** @var bool $isGuest */
/** @var User $user */
/** @var View $this */
?>

<?php if ($enabled):?>
    <?php echo $this->render('cw__app', [
    ]) ?>
<?php else :?>
    <?php if ($isGuest): ?>
<div class="alert alert-primary" role="alert">
  Для доступа к приложению необходимо авторизоваться!
</div>
    <?php else: ?>
<div class="alert alert-warning" role="alert">
Ваша учетная запись не активирована. Для активации учетной записи перейдите по ссылке, отправленной на электронную почту.
Если письмо не находится, попробуйте повторить отправку нажав на ссылку  
    <?php echo Html::a('Отправить ссылку для активации', Url::toRoute(['invite','id' => $user->id ])) ?>
    <?php endif; ?>
</div>
<?php endif; ?>

