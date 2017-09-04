<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginAsset;
use yii\widgets\Pjax;

LoginAsset::register($this);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php \Yii::$app->view->registerMetaTag(['name' => 'X-FRAME-OPTIONS','content' => 'DENY']); ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    
    <?= Html::csrfMetaTags() ?>
  
    <?php $this->head() ?>
    <style>
        .nav-bgcolor{
            background-color:#6a1a41;
            width:200%; 
        }
    </style>
</head>

    
   
<?php $this->beginBody(['class' => '']); ?>
    
    <?php // $a = get_browser(null, true);
//    var_dump($a)?>


   <?php Pjax::begin(['timeout' => 5000 ]) ?>
 <?php
    
       echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
           $login = Yii::$app->user->isGuest ? (
                ['label' => '', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->user_email . ')',
                    ['class' => 'btn btn-link']
            )
                . Html::endForm()
   
                . '</li>'
                   
            )
        ],
    ]);
  
    ?>
    <?php Pjax::end() ?>

    <div class="container">
        
        <?= $content ?>
    </div>

<?php $this->endBody() ?>


</html>

<?php $this->endPage() ?>
