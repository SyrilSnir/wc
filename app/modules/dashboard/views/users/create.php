<?php

use app\models\Forms\Manage\Users\UserForm;
use yii\web\View;



/** @var View $this  */
/** @var UserForm $model  */

$this->title = 'Новый пользователь';
?>

<div class="create-form">
    
<?php echo $this->render('_form', [
        'model' => $model,
]) ?>

</div>

