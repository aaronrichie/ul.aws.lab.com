<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ul_lab_description".
 *
 * @property integer $lab_description_id
 * @property integer $lab_id
 * @property string $lab_description
 * @property string $lab_file_path
 */
class LabDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    
    public static function tableName()
    {
        return 'ul_lab_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_description'],'required'],
            [['lab_description_id', 'lab_id'], 'integer'],
            [['file'],'file'],
            [['lab_description'], 'string', 'max' => 3000],
            [['lab_file_path'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_description_id' => 'Lab Description ID',
            'lab_id' => 'Lab ID',
            'lab_description' => 'Lab Description',
            'lab_file_path' => 'Lab File Path',
        ];
    }
}
