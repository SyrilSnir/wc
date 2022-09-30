<?php

use app\assets\MainAsset;
use app\core\helpers\Menu\NavMenuHelper;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
        <title><?= Html::encode($this->title) ?></title>
    </head>
    <body>
<header id="header">
    <?php
    /** @var NavMenuHelper $navMenuHelper */
    $navMenuHelper = Yii::$container->get(NavMenuHelper::class);
    NavBar::begin([
        'brandImage' => '/build/images/logo.png',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $navMenuHelper->getMenu()
    ]);
    NavBar::end();
    ?>
</header>        
        <?php $this->beginBody() ?>

<main id="main" class="flex-shrink-0" role="main">        
        <div class="container-fluid">
          <section class="section">
              <?php if (Yii::$app->session->hasFlash('info')): ?>
              <div class="alert alert-success">
                    <?php echo Yii::$app->session->getFlash('info'); ?>
            </div> 
              <?php endif; ?>
              <?php if (Yii::$app->session->hasFlash('warning')): ?>
              <div class="alert alert-warning">
                    <?php echo Yii::$app->session->getFlash('warning'); ?>
            </div>
              <?php endif; ?>              
        <?= $content ?>
        </section>
            </div>
    </main>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>