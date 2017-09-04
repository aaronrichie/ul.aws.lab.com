<?php

namespace app\controllers;

use Yii;
use app\models\LabDescription;
use app\models\LabDescriptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LabDescriptionController implements the CRUD actions for LabDescription model.
 */
class LabDescriptionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LabDescription models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new LabDescriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=>$id,
        ]);
    }

    /**
     * Displays a single LabDescription model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LabDescription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new LabDescription();

        if ($model->load(Yii::$app->request->post())) {
            $labManual = \app\models\LabManual::findOne($id);
            $model->lab_id = $id;
            $model->save();
            $imageName = $labManual->lab_manual_name.'_'.$model->lab_description_id;
            $model->file = \yii\web\UploadedFile::getInstance($model,'file');
               if($model->file != null){
                    $imageName = str_replace(' ','',$labManual->lab_manual_name).'-'.$id;
                    $model->file->saveAs( 'web/images/courses/'.$imageName.'.'.$model->file->extension );
                    $model->lab_file_path = '/web/images/courses/'.$imageName.'.'.$model->file->extension;
                }
            $model->save();
            $user = \app\models\UlUser::find()->all();
            foreach($user as $saveUser){
                $completion = new \app\models\LabCompletion();
                $completion->user_id = $saveUser->user_id;
                $completion->lab_description_id = $model->lab_description_id;
                $completion->save();
            }
            return $this->redirect(['view', 'id' => $model->lab_description_id]);
            
        }else {
            return $this->render('create', [
                'model' => $model,
                'id'=>$id,
            ]);
        }
    }

    /**
     * Updates an existing LabDescription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $labManual = \app\models\LabManual::findOne($model->lab_id);
                $model->file = \yii\web\UploadedFile::getInstance($model,'file');
                if($model->file != null){
                    $imageName = str_replace(' ','',$labManual->lab_manual_name).'-'.$id;
                    $model->file->saveAs( 'web/images/courses/'.$imageName.'.'.$model->file->extension );
                    $model->lab_file_path = '/web/images/courses/'.$imageName.'.'.$model->file->extension;
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->lab_description_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id'=> $id,
            ]);
        }
    }

    /**
     * Deletes an existing LabDescription model.
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
     * Finds the LabDescription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LabDescription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabDescription::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
