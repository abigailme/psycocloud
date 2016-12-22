<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Paciente;

/**
 * PacienteSearch represents the model behind the search form about `frontend\models\Paciente`.
 */
class PacienteSearch extends Paciente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPaciente', 'cedula', 'edad', 'cantidad_citas', 'celular', 'local', 'Psiquiatra_idPsiquiatra'], 'integer'],
            [['p_nombre', 's_nombre', 'p_apellido', 's_apellido', 'fecha_nacimiento', 'email', 'motivo_consulta', 'antecedentes', 'created_at', 'seudonimo'], 'safe'],
            [['tarifa', 'deuda'], 'number'],
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
        $query = Paciente::find();

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

        $query->joinWith('psiquiatra');

        // grid filtering conditions
        $query->andFilterWhere([
            'idPaciente' => $this->idPaciente,
            'cedula' => $this->cedula,
            'edad' => $this->edad,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'created_at' => $this->created_at,
            'cantidad_citas' => $this->cantidad_citas,
            'celular' => $this->celular,
            'local' => $this->local,
            'tarifa' => $this->tarifa,
            'deuda' => $this->deuda,
        ]);

        $query->andFilterWhere(['like', 'p_nombre', $this->p_nombre])
            ->andFilterWhere(['like', 's_nombre', $this->s_nombre])
            ->andFilterWhere(['like', 'p_apellido', $this->p_apellido])
            ->andFilterWhere(['like', 's_apellido', $this->s_apellido])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'motivo_consulta', $this->motivo_consulta])
            ->andFilterWhere(['like', 'antecedentes', $this->antecedentes])
            ->andFilterWhere(['like', 'seudonimo', $this->seudonimo])
            ->andFilterWhere(['like', 'psiquiatra.nombre', $this->Psiquiatra_idPsiquiatra]);

        return $dataProvider;
    }
}
