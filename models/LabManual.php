<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ul_lab_manual".
 *
 * @property integer $lab_id
 * @property string $lab_manual_name
 * @property string $created_date
 * @property integer $lab_completed
 */
class LabManual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public $completed;
    
    public static function tableName()
    {
        return 'ul_lab_manual';
    }
    
   

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date'], 'safe'],
            [['lab_completed'], 'integer'],
            [['lab_manual_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_id' => 'Lab ID',
            'lab_manual_name' => 'Lab Manual Name',
            'created_date' => 'Created Date',
            'lab_completed' => 'Lab Completed',
        ];
    }
    
    /*
     * Author: Aaron Richie Dias
     * Function:set lab completion to 0 or 1 based on the completed bpx checked.
     */
    public function labComplete($id){
        $complete = LabCompletion::find()->where(['user_id'=>Yii::$app->user->identity->user_id,'lab_description_id'=> $id])->one();
        return $complete->lab_completion;
    }
    
    public function percentageComplete($id){
        $description = LabDescription::find()->where(['lab_id'=>$id])->all();
        $completionArray = [];
        foreach($description as $desc){
            $completionArray[] = $desc->lab_description_id;
        }
       if(count($completionArray) > 0){
           $labCompArray = [];
           foreach($completionArray as $complete){
               $lab = LabCompletion::find()->where(['user_id'=>Yii::$app->user->identity->user_id, 'lab_description_id'=>$complete])->one();
               if($lab->lab_completion == 1){
                   $labCompArray[] = $lab->lab_completion;
               }
           }
           $percentage = (count($labCompArray)/count($completionArray))*100;
           return $percentage;
       }
    }
}
