<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\MarkdownEditor;
use yii\helpers\Markdown;

/* @var $this yii\web\View */
/* @var $model app\models\LabManual */

//$this->title = $model->lab_id;
$this->params['breadcrumbs'][] = ['label' => 'Lab Manuals', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .breadcrumb{background-color:#6a1a41;}
    .breadcrumb>li>a{color:#ffffff;}
/*    .logo-container{margin-top:5px; margin-bottom: 10px;position: relative;width: 40em; height: 100em;}
    .logo-container img{position: absolute;top: 10%; left: 50%;  width: auto; height: auto;  max-width: 100%; max-height: 100%;  transform: translate(-50%, -50%); }*/
</style>
<?php
    $this->registerJs("
           jQuery('body').on('click', '.next-button', function() {
            var i = $(this).attr('id');
            var id= '$model->lab_id';
            $.ajax({
                type: 'POST',
                cache: false,
                data:{'i': i,'id': id},
                url: '".Yii::$app->getUrlManager()->createUrl("lab-manual/next-button")."',
                dataType: 'json',
                success: function(data){ 
                    if(data.status){
                        window.location.href = data.url;
                    }else{
                        krajeeDialog.alert(data.message);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                           if(thrownError == 'Forbidden'){window.location = 'http://test.qsims.com/index.php/product/check-file'; }
                }
                });
            });
            
    ");
?>
<div class="lab-manual-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
//        foreach($labs as $lab){
//            echo $lab->lab_description;echo '<br>';
//        }
    if(count($labs) > 0){
        if($i < count($labs)){
            $this->registerJs("
                $('body').on('click','#labDesc-".$labs[$i]->lab_description_id."', function(){
                    var id = $(this).attr('id').split('-');
                    var user = '".Yii::$app->user->identity->user_id."';
                      //  alert(id[1]);alert(user);
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        data:{'id': id[1],'user': user},
                        url: '".Yii::$app->getUrlManager()->createUrl("lab-manual/complete")."',
                        dataType: 'json',
                        success: function(data){ 
                            if(data.status){
                                //window.location.href = data.url;
                            }else{
                               // krajeeDialog.alert(data.message);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                                   if(thrownError == 'Forbidden'){window.location = 'http://test.qsims.com/index.php/product/check-file'; }
                        }
                        });
                });
            ");
            echo '<div class=\'col-md-12\'>';
                echo '<div class=\'col-md-6\'>';
                    $myHtml = Markdown::process($labs[$i]->lab_description, 'gfm'); 
                    echo $myHtml;
                echo '</div>';
                echo '<div class=\'col-md-6 logo-container\'>';
                    if(substr($labs[$i]->lab_file_path,-3) == 'mp4'){
                        echo '<iframe class="embed-responsive-item" src="'.$labs[$i]->lab_file_path.'" style="width:100%" frameborder="0" allowfullscreen></iframe>';
                    }else{
                        echo Html::img($labs[$i]->lab_file_path,['style'=>'width:100%', 'alt'=>'png']);
                    }
                echo '</div>';
            echo '</div>';
                    echo "<br>";
                    if($i == 0){
                        echo Html::a('Previous','#',['class'=>'btn-success btn-sm btn','style'=>'margin-right:5px;', 'disabled'=>true]);
                    }else{
                        echo Html::a('Previous',['lab-manual/previous-button','id'=>$model->lab_id,'i'=>$i],['class'=>'btn-primary btn-sm btn','style'=>'margin-right:5px;']);
                    }
                    if($i+1 == count($labs)){
                        echo Html::a('Next','#',['class'=>'btn-success btn-sm btn', 'disabled'=>true]);
                    }else{
                        echo Html::a('Next',['lab-manual/next-button','id'=>$model->lab_id,'i'=>$i],['class'=>'btn-primary btn-sm btn']);
                    }
                        echo Html::checkbox('agree',$model->labComplete($labs[$i]->lab_description_id), ['label' => 'Completed','style'=>'margin-left:5px;','id'=>'labDesc-'.$labs[$i]->lab_description_id]);
        }
    }
    ?>
    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'lab_id',
            'lab_manual_name',
            'created_date',
            'lab_completed',
        ],
    ]) ?>
    <div style="margin-bottom:700px;"></div>
</div>
