<?php

namespace app\controllers;

use Yii;
use app\models\LabManual;
use app\models\LabManualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;

/**
 * LabManualController implements the CRUD actions for LabManual model.
 */
class LabManualController extends Controller
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['index','create','update','view','delete','next-button','previous-button','complete'],
                    ],
//                   [
//                        'allow' => true,
//                        'roles' => ['companyAdmin'],
//                        'verbs' => ['POST','GET']
//                    ],
              
                ],
            ],
            
            
        ];
    }

    /**
     * Lists all LabManual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LabManualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LabManual model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $lab = \app\models\LabDescription::find()->where(['lab_id'=>$id])->all();
        return $this->render('view',[
            'model' => $this->findModel($id),
            'labs' => $lab,
            'i'=>0,
        ]);
    }
    
    public function actionNextButton($id,$i)
    {
        $lab = \app\models\LabDescription::find()->where(['lab_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'labs' => $lab,
            'i'=>$i+1,
        ]);
    }
    
      public function actionPreviousButton($id,$i)
    {
        $lab = \app\models\LabDescription::find()->where(['lab_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'labs' => $lab,
            'i'=>$i-1,
        ]);
    }

    /**
     * Creates a new LabManual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LabManual();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lab_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LabManual model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lab_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LabManual model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LabManual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LabManual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabManual::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * Author: Aaron Richie Dias
     * Function: checks the complete flag to 1, which indicates that the course is complete
     * param $id= is the lab_description_id and the user is lab_description_user
     */
    public function actionComplete(){
          if((isset($_POST['id']))){
            $id = $_POST['id'];
            $user = $_POST['user'];
            $model = \app\models\LabCompletion::find()->where(['user_id'=>$user, 'lab_description_id'=>$id])->one();
            if($model){
                if($model->lab_completion == 0){
                    $model->lab_completion = 1;
                }else{
                    $model->lab_completion = 0;
                }
              
                if($model->save()){
                    echo Json::encode([
                        'status'=>true,
                    ]);
                }else{
                     echo Json::encode([
                        'status'=>false,
                    ]);
                }
            }
        }else{
            echo Json::encode([
                'status'=>false,
                'message'=>"Error occurred. Please refresh the page and try again.",
            ]);
        }
    }
}
