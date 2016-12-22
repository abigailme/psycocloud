<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cita;

/**
 * CitaSearch represents the model behind the search form about `frontend\models\Cita`.
 */
class CitaSearch extends Cita
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCita', 'show_up', 'cancelado', 'Paciente_idPaciente'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            [['tarifa'], 'number'],
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
        $query = Cita::find();

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

        $query->joinWith('paciente');

        // grid filtering conditions
        $query->andFilterWhere([
            'idCita' => $this->idCita,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'show_up' => $this->show_up,
            'cancelado' => $this->cancelado,
            'tarifa' => $this->tarifa,
        ]);

        $query->andFilterWhere(['like', 'paciente.p_nombre', $this->Paciente_idPaciente]);

        return $dataProvider;
    }
}
