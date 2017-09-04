<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\password\PasswordInput;
?>
<?php
    $this->registerJs('
       $(".flash-login").animate({opacity: 1.0}, 3000).fadeOut();
       $("#loginform-password").attr("placeholder", "*******");     
    ');  
?>

<?php
$this->context->layout = 'Login';
//$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;0
?>

<body style="background:#F7F7F7;">
<nav class="navbar nav-bgcolor navbar-static-top">
 
</nav>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable flash-login">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('failure')): ?>
                <div class="alert alert-danger alert-dismissable flash-login">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('failure') ?>
                </div>
        <?php endif; ?>
        
         <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>UL AWS</b>Lab</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'enableAjaxValidation'=>false,
            'enableClientValidation' => true,
            'options' => ['class' => 'form disable-submit-buttons'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-12 col-xs-12 col-sm-12\">{input}</div>\n<div class=\" margin-top-3  \"></div>",
                'labelOptions' => ['class' => 'alignleft padding-0 control-label'],

            ],  
        ]); ?>
        
          <h3 style="text-align:center;">Sign Up</h3> 
                <div>
                <?php // $form->errorSummary($model, $options = ['header'=>'', 'class'=>'pull-left errorDiv']); ?>
                </div>
                <?= $form->field($model, 'user_fname')->textInput(['style'=>'margin-bottom:10px;','placeholder'=>'First Name*','class'=>'form-control'])->label('First Name',['style' => 'margin-left:18px;']);?>
                <?= $form->field($model, 'user_lname')->textInput(['style'=>'margin-bottom:10px;','placeholder'=>'Last Name*','class'=>'form-control col-lg-4'])->label('Last Name',['style' => 'margin-left:18px;']); ?>
                <?= $form->field($model,'user_email')->textInput(['style'=>'margin-bottom:10px;','placeholder'=>'Email*','class'=>'form-control col-lg-4'])->label('Email',['style' => 'margin-left:18px;']); ?>
                <?php  echo $form->field($model, 'user_password')->textInput(['style'=>'margin-bottom:10px;'])->label('Password',['style' => 'margin-left:18px;']);?>

                <?php // echo $form->field($model, 'reCaptcha')->widget(
              //      \himiklab\yii2\recaptcha\ReCaptcha::className(),
              //      ['siteKey' => '6LeY1BAUAAAAALThRhBQ-sJaXbP0Z5i9XFuaz_VW']
              //  )->label(false); ?>
               

            <?php //echo $form->field($model, 'agree')->checkbox([
                   //   'template' => "<div class=\"padding-0 alignleft\">{input} {label}</div>\n<div class=\"col-lg-12 col-sm-12 col-xs-12\"></div>",
              //  ]); ?>
         
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
               <?= Html::submitButton('Sign Up', ['class' => 'pull-left padding-0 btn btn-primary','style'=>'margin-left:18px;','id' => 'submitCaptcha', 'name' => 'signup-button','data' => ['disabled-text' => 'Please Wait']]) ?>
            </div><!-- /.col -->
          </div>
      
     
        <?php ActiveForm::end([]);?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

        

</body>
</html>

