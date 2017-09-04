<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabDescriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Lab Descriptions';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Lab Manuals', 'url' => ['lab-manual/index']];
?>

<style>
    .breadcrumb{background-color:#6a1a41;}
    .breadcrumb>li>a{color:#ffffff;}
    .GridHeadingColor{  background-image: linear-gradient(to bottom,#c15388 0%,#FFFFFF 100%); } 
    .GridHeadingColor > th > a{color: black !important;} 
    .GridRowColor {color: #57585b;}  
    .GridRowColor > td > a{font-weight: bold;color: #213447;} 
    .GridRowColor > td > a:hover {color: #466789 !important;}
    .global-search{ overflow: hidden;margin-right:1%;}
    .submit-search{margin-right:1%;}
    .global-search1{width:100%;}
    .select2-search__field{width:100% !important;}
</style>
<div class="lab-description-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if(Yii::$app->user->identity->user_role == 1){
                $createButton = Html::a('Create Lab Description', ['create','id'=>$id], ['class' => 'btn btn-default']);
            }else{
                $createButton = '';
            }            
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'headerRowOptions' => [
            'class' => 'GridHeadingColor'
        ],
        'rowOptions' => [
            'class' => 'GridRowColor'
        ],
    //    'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'lab_description',
            ['class' => 'yii\grid\ActionColumn', 
                'header' => $createButton,
                'options'=>['style'=>'width:70px;']], 
            ], 
        'tableOptions' =>['class' => 'table table-responsive table-bordered table-hover table-shadow shadow bgStyle'],
        
    ]); ?>
</div>
