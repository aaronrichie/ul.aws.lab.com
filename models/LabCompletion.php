<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ul_lab_completion".
 *
 * @property integer $lab_completion_id
 * @property integer $user_id
 * @property integer $user_lab_description_id
 * @property integer $lab_completion
 */
class LabCompletion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ul_lab_completion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'lab_description_id'], 'required'],
            [['user_id', 'lab_description_id', 'lab_completion'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_completion_id' => 'Lab Completion ID',
            'user_id' => 'User ID',
            'lab_description_id' => 'User Lab Description ID',
            'lab_completion' => 'Lab Completion',
        ];
    }
}
