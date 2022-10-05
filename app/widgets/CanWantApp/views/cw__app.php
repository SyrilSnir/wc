<?php

use app\core\services\auth\Rbac;
use app\widgets\CanWantApp\assets\CanWantAppAsset;


    $assetBundle = CanWantAppAsset::register($this);
    
?>
<div class="cw__app">
    <h2>Здесь будет находится приложение WANT CAN.</h2>
    <div class="content__box">
        <div class="image__box"><img src="<?php echo $assetBundle->baseUrl .  '/images/uc.jpg'?>" alt="Under Construction" class="image"></div>
        <?php if (Yii::$app->user->can(Rbac::PERMISSION_ADMIN_DASHBOARD)): ?>
        <div class="text__box"><a href="/dashboard">Перейти на панель управления</a></div>
        <?php endif; ?>
    </div>
</div>