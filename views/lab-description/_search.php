<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LabDescriptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-description-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lab_description_id') ?>

    <?= $form->field($model, 'lab_id') ?>

    <?= $form->field($model, 'lab_description') ?>

    <?= $form->field($model, 'lab_file_path') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
