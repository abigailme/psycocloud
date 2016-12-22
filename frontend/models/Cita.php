<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Paciente;

/**
 * This is the model class for table "cita".
 *
 * @property string $idCita
 * @property string $fecha
 * @property string $hora
 * @property integer $show_up
 * @property integer $cancelado
 * @property integer $Paciente_idPaciente
 * @property double $tarifa
 *
 * @property Paciente $pacienteIdPaciente
 */
class Cita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'hora'], 'required'],
            [['fecha', 'hora'], 'safe'],
            [['show_up', 'cancelado', 'Paciente_idPaciente'], 'integer'],
            [['tarifa'], 'number'],
            [['Paciente_idPaciente'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::className(), 'targetAttribute' => ['Paciente_idPaciente' => 'idPaciente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCita' => 'Id Cita',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'show_up' => 'Show Up',
            'cancelado' => 'Cancelado',
            'Paciente_idPaciente' => 'Nombre del Paciente',
            'tarifa' => 'Tarifa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacienteIdPaciente()
    {
        return $this->hasOne(Paciente::className(), ['idPaciente' => 'Paciente_idPaciente']);
    }

    //mostrar la lista de Pacientes para el combo box
    public static function getListaPaciente(){
        $opciones = Paciente::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'idPaciente', 'p_nombre', 'p_apellido');
    }

        //Mostrar si se presento
    public function getShowUp(){
        return $this->show_up ? 'Si' : 'No';
    }

    //Mostrar si pago
    public function getCancelo(){
        return $this->cancelado ? 'Si' : 'No';
    }


    //Consigue un paciente ['idPaciente' => $id]
    public static function getPacienteNombre($id){
        $nombre = Paciente::find()->where(['idPaciente' => $id])->asArray()->one();
        return ArrayHelper::getValue($nombre, 'p_nombre', '-sin Nombre-');
    }

    //Mostrar el nombre del paciente en el index
    public function getPaciente()
    {
        return $this->hasOne(Paciente::className(), ['idPaciente' => 'Paciente_idPaciente']);
    }

    //Busca el modelo del Paciente Seleccionado
    public function getModeloPaciente($id){
        $idP = Paciente::find()->where(['idPaciente' => $id])->asArray()->one();
        return ArrayHelper::getValue($idP, 'idPaciente');
    }
}
