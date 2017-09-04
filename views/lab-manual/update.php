<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LabManual */

$this->title = 'Update Lab Manual: ' . $model->lab_id;
$this->params['breadcrumbs'][] = ['label' => 'Lab Manuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lab_id, 'url' => ['view', 'id' => $model->lab_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-manual-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
