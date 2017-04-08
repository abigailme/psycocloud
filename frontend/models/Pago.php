<?php

namespace frontend\models;

use Yii;
use frontend\models\Paciente;
use yii\helpers\ArrayHelper;

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
 * @property integer $email
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
            ['deuda', 'number'],
            [['tipoPago_idtipoPago', 'Paciente_idPaciente', 'Nombre'], 'required'],
            [['tipoPago_idtipoPago', 'Paciente_idPaciente', 'email'], 'integer'],
            [['Nombre'], 'string', 'max' => 45],
            ['monto', 'number', 'min' => 1],
            [['Descripcion'], 'string', 'max' => 100],
            ['Descripcion', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan numeros'],
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
            'email' => 'Enviar correo electrónico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacienteIdPaciente()
    {
        return $this->hasOne(Paciente::className(), ['idPaciente' => 'Paciente_idPaciente']);
    }

    public function emailPaciente($id){
        $paciente = Paciente::findOne($id);
        return $paciente->email;
    }

    //Mostrar solo el nombre del psiquiatra para el view
    public function getNombrePaciente($id){
        $idP = Paciente::find()->where(['idPaciente' => $id])->asArray()->one();
        return  \Yii::$app->encrypter->decrypt(ArrayHelper::getValue($idP, 'p_nombre', '-sin Nombre-'));
    }

    //Busca el modelo del psiquiatra Seleccionado
    public function getModeloPaciente($id){
        $idP = Paciente::find()->where(['idPaciente' => $id])->asArray()->one();
        return ArrayHelper::getValue($idP, 'idPaciente');
    }

        //Mostrar si se presento
    public function getPago(){
        if($this->tipoPago_idtipoPago == 1){
            return 'Efectivo';
        }
        else{
            return 'Transferencia';
        }
    }
}
