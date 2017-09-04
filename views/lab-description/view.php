<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LabDescription */

$this->title = $model->lab_description_id;
$this->params['breadcrumbs'][] = ['label' => 'Lab Descriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-description-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->lab_description_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->lab_description_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'lab_description_id',
            'lab_id',
            'lab_description',
            'lab_file_path',
        ],
    ]) ?>

</div>
