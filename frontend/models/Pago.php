<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property integer $idFactura
 * @property double $monto
 * @property double $deuda
 * @property integer $tipoPago_idtipoPago
 * @property integer $Paciente_idPaciente
 * @property string $Nombre
 * @property string $Descripcion
 *
 * @property Paciente $pacienteIdPaciente
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto', 'deuda'], 'number'],
            [['tipoPago_idtipoPago', 'Paciente_idPaciente', 'Nombre'], 'required'],
            [['tipoPago_idtipoPago', 'Paciente_idPaciente'], 'integer'],
            [['Nombre'], 'string', 'max' => 45],
            [['Descripcion'], 'string', 'max' => 100],
            [['Paciente_idPaciente'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::className(), 'targetAttribute' => ['Paciente_idPaciente' => 'idPaciente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFactura' => 'Id Factura',
            'monto' => 'Monto',
            'deuda' => 'Deuda',
            'tipoPago_idtipoPago' => 'Tipo de Pago',
            'Paciente_idPaciente' => 'Id Paciente',
            'Nombre' => 'Nombre',
            'Descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacienteIdPaciente()
    {
        return $this->hasOne(Paciente::className(), ['idPaciente' => 'Paciente_idPaciente']);
    }
}
