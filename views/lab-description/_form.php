<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model app\models\LabDescription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-description-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

        <?php     
        echo $form->field($model, 'lab_description')->widget(
            MarkdownEditor::classname(), 
            [   
                'height' => 83, 
                'exportFileName' => 'lab-export',
                'smarty' => true,
                'showExport' => false,
                'footerMessage'=> false, 
                'buttonOptions' => ['class' => 'btn btn-xs btn-default', 'BTN_EXPORT'=> false],  
            ]
        );?>
    
    <?php $form->field($model, 'lab_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
