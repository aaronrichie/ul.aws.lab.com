<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LabDescription;

/**
 * LabDescriptionSearch represents the model behind the search form about `app\models\LabDescription`.
 */
class LabDescriptionSearch extends LabDescription
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_description_id', 'lab_id'], 'integer'],
            [['lab_description', 'lab_file_path'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$id)
    {
        $query = LabDescription::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'lab_description_id' => $this->lab_description_id,
            'lab_id' => $id,
        ]);

        $query->andFilterWhere(['like', 'lab_description', $this->lab_description])
            ->andFilterWhere(['like', 'lab_file_path', $this->lab_file_path]);

        return $dataProvider;
    }
}
