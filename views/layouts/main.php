<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .nav-bgcolor{
            background-color:#FFFFFF;
            width:100%; 
        }
    </style>
</head>
<body style="background-color:#e9ecf1;">
<nav class="navbar nav-bgcolor">
    <ul style="text-decoration:none;">
        <li style="margin-left:30%;list-style:none;"> <img src="/web/images/logo/university-of-limerick_logo.gif" alt="Upload Image" style ="width:250px" class ="companyLogo " /> </br></br></li>
    </ul>
    <div class="clearfix"></div>
    <ul>
        <li class="pull-right" style="color:#6a1a41;margin-right:15px;margin-top:-15px;list-style:none;">
            <h5><a style='text-decoration:none;color:#6a1a41;' href="<?= Url::toRoute('/site/logout') ?>">
                          <i class="glyphicon glyphicon-log-out"></i>
                             <?= Yii::t('app','Logout') ?>
            </a>
            </h5>
        </li>
    </ul>
</nav>
<?php $this->beginBody() ?>

    <div class="container" style="color:#6a1a41;width:90%;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
   
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
