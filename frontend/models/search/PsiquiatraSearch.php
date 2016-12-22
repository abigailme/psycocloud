<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Psiquiatra;

/**
 * PsiquiatraSearch represents the model behind the search form about `frontend\models\Psiquiatra`.
 */
class PsiquiatraSearch extends Psiquiatra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPsiquiatra', 'telefono'], 'integer'],
            [['nombre', 'apellido', 'email'], 'safe'],
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
        $query = Psiquiatra::find();

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
            'idPsiquiatra' => $this->idPsiquiatra,
            'telefono' => $this->telefono,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
