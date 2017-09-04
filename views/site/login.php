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
                        'id' => 'login-form',                     
                        'options' => ['class' => 'form-horizontal disable-submit-buttons'],
                        'fieldConfig' => [
                            'template' => "<div class=\"col-md-12 col-sm-12 col-xs-12\">{input}</div>\n<div></div>",
                        ],
                    ]); ?>
          <div class="form-group has-feedback">
            <?= $form->errorSummary($model, $options = ['header'=>'', 'class'=>'pull-left errorDiv']); ?>
            <?= $form->field($model,'email')->textInput(['placeholder'=>'Email','class'=>'form-control col-lg-4'])->label(false); ?>        
          
          </div>
          <div class="form-group has-feedback">
            <?php  echo $form->field($model, 'password')->passwordInput();?>
           
          </div>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <?= Html::submitButton('Login', ['class' => 'btn btn-primary nav-bgcolor alignleft','style'=>'margin-top:20px;margin-left:-220px;', 'id' => 'login-button', 'name' => 'login-button','data' => ['disabled-text' => 'Please Wait']]);?> 
            </div><!-- /.col -->
          </div>
        </form>
        <a href="#" style="margin-left:10px;">I forgot my password</a><br>
        <a href="register.html" class="text-center" style="margin-left:10px;">Register a new membership</a>
        <?php ActiveForm::end([]);?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

        

</body>
</html>