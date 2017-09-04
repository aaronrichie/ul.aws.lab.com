<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LabDescription */

$this->title = 'Create Lab Description';
$this->params['breadcrumbs'][] = ['label' => 'Lab Descriptions', 'url' => ['index','id'=>$id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
   
    .breadcrumb{background-color:#6a1a41;}
    .breadcrumb>li>a{color:#ffffff;}
/*    .logo-container{margin-top:5px; margin-bottom: 10px;position: relative;width: 40em; height: 100em;}
    .logo-container img{position: absolute;top: 10%; left: 50%;  width: auto; height: auto;  max-width: 100%; max-height: 100%;  transform: translate(-50%, -50%); }*/
</style>

<div class="lab-description-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
