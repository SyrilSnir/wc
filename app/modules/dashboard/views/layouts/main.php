<?php

use app\assets\DashboardAsset;
use yii\helpers\Html;
use yii\web\View;


/* @var $this View */
/* @var $content string */
DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head> 
    <meta charset="<?= Yii::$app->charset ?>">    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">   
        <?= Html::csrfMetaTags() ?>    
        <?php $this->head() ?>    
        <title><?= Html::encode($this->title) ?></title>    
</head>

<body>
    <!-- Navbar -->
    <?php echo $this->render('parts/navbar.php'); ?>
    <!-- End Navbar -->
    <!-- SideBar -->    
    <?php echo $this->render('parts/sidebar.php'); ?> 
    <?php echo $this->render('parts/content.php',[
        'content' => $content
    ]); ?> 

    <!-- End sidebar -->
            <?php $this->beginBody() ?>
            <?php $this->endBody() ?>
    
</body>
</html>
<?php $this->endPage() ?>
    
