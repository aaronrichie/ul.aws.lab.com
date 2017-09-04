<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\LabManualSearch;
use app\models\LabManual;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
               
                'rules' => [
                    [
                        'actions' => ['login','signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                     [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
           
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['lab-manual/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                 return $this->redirect(['lab-manual/index']);
            }
          
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSignup(){
        $model = New \app\models\UlUser();
        if($model->load(Yii::$app->request->post())){
            $model->setPassword($model->user_password);
        
            //$model->generateAuthKey(); 
            $token = Yii::$app->security->generateRandomString();
            $model->user_access_token = $token;
            $model->user_verify = 0;

            if($model->save()){
                $description = \app\models\LabDescription::find()->all();
                foreach($description as $desc){
                    $complete = new \app\models\LabCompletion();
                    $complete->user_id = $model->user_id;
                    $complete->lab_description_id = $desc->lab_description_id;
                    $complete->save();
                }
                return $this->redirect(['lab-manual/index']);
            }
        }
        return $this->render('signup',['model'=>$model]);
    }
    
//      public function actionSignup()
//    {
//        $browser = new Browser;
//        if( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() < 11 ) 
//            {   
//                return $this->render('browser');                                                                                                                                   
//        }
//        $company = new Company(); 
//        $model = new SimUser(['scenario' => SimUser::SCENARIO_REGISTER]);
//        
//       
//     
//        if ($model->load(Yii::$app->request->post())&& $model->validate() && $company->load(Yii::$app->request->post()) && $company->validate()) {
//        
//            $model->setPassword($model->user_password_hash);
//            $model->generateAuthKey(); 
//            $token = Yii::$app->security->generateRandomString();
//            $model->user_access_token = $token;
//            $model->user_verified = 0;
//            $company->save();
//            $model->company_id = $company->company_id; 
//         //   $model->reCaptcha = '';
//        
//            if ($model->save(false)){
//                $auth = Yii::$app->authManager;
//                $authorRole = $auth->getRole('company_admin');
//                $auth->assign($authorRole, $model->user_id);
//                $path = 'C:/wamp/www/test.qsims.com/web/gentelella-1.2.0/production/images/DCMLogo.png';
//                Yii::$app->mailer->compose('@app/mail/layouts/verify',['model' => $model, 'path' => $path,'token' => $model->user_access_token])
//                       ->setTo($model->user_email)
//                       ->setFrom('test.qsims@gmail.com')
//                       ->setSubject('Welcome to Qsims'.$model->user_fname." ".$model->user_lname.'. Verify your account to continue')
//                       ->setTextBody('Verify Account')
//                       ->send(); 
//                return $this->render('verifyNew',['email' => $model->user_email]);
//            }
//            else{
//                alert('Something went wrong');
//            }
//            
//          //  \Yii::$app->user->login($model);
//           //   return $this->render('verifyNew',['email' => $model->user_email]);
//        }
//        
//        return $this->render('signup', [
//            'model' => $model,
//            'company' => $company,
//         
//        ]);
//    }
}
