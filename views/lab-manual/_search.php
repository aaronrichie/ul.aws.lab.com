<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LabManualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-manual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'globalSearch',['template' => '
        <div class="col-md-3 col-sm-4 col-xs-12 global-search">
            <div class="row">
                <div class="input-group global-search1 ">
                    {input}
                </div>
            </div>  
        </div>'])->textInput(['style'=>'border-radius:4px;','class'=> 'form-control','data-default' => '','placeholder'=> Yii::t('app','Search...').'....'])->label(Yii::t('app','Internal Code'));?>
  
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
