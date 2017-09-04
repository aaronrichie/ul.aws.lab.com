<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LabManual */

$this->title = 'Create Lab Manual';
$this->params['breadcrumbs'][] = ['label' => 'Lab Manuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .breadcrumb{background-color:#6a1a41;}
    .breadcrumb>li>a{color:#ffffff;}
</style>
<div class="lab-manual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
