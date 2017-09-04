<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LabManual;

/**
 * LabManualSearch represents the model behind the search form about `app\models\LabManual`.
 */
class LabManualSearch extends LabManual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_id', 'lab_completed'], 'integer'],
            [['lab_manual_name', 'created_date','globalSearch'], 'safe'],
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
    public function search($params)
    {
        $query = LabManual::find();

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
            'lab_id' => $this->lab_id,
            'created_date' => $this->created_date,
            'lab_completed' => $this->lab_completed,
            'lab_manual_name' => $this->lab_manual_name,
        ]);

        $query->andFilterWhere(['like', 'lab_manual_name', $this->globalSearch])
                ->orFilterWHere(['like', 'lab_id', $this->globalSearch]);
        

        return $dataProvider;
    }
}
