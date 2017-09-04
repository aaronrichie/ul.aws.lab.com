<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LabManualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Lab Manuals';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
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
<div class="lab-manual-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
       
      <?php
        if(Yii::$app->user->identity->user_role == 1){
           $createButton = Html::a('Create Lab Manual', ['create'], ['class' => 'btn btn-default', 'style'=>['color'=>'#6a1a41','width:100%;']]);
        }else{
            $createButton = '';
        }
       ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'headerRowOptions' => [
            'class' => 'GridHeadingColor'
        ],
        'rowOptions' => [
            'class' => 'GridRowColor'
        ],
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],     
            [
                'attribute' => 'lab_manual_name',
                'headerOptions' => ['style' => 'width:25%'],
                'label'=>Yii::t('app','Title'),
                'format' => 'raw', 
                'value'=>function ($data) {
                            return  Html::a(Yii::t('app',$data->lab_manual_name), ['lab-description/index','id'=>$data->lab_id]);
                        }
            ],
            'created_date',
            [
                        'attribute' => 'completed',
                        'label'=>Yii::t('app','Lab Progress'),
                        'format' => 'raw',
                        'value'=>function ($data) {
                                 $percent = $data->percentageComplete($data->lab_id);
                                 return Progress::widget([
                                        'percent' => $percent,
                                        'label' => $percent.'%',
                                        'barOptions' => ['class' => 'progress-bar-success'],
                                        'options' => ['class' => 'active progress-striped'],
                                    ]);
                                },
                    ],
            
            ['class' => 'yii\grid\ActionColumn', 
                'header' => $createButton,
                'options'=>['style'=>'width:70px;']], 
            ], 
         'tableOptions' =>['class' => 'table table-responsive table-bordered table-hover table-shadow shadow bgStyle'],
    ]); ?>
</div>
