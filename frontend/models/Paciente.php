<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Psiquiatra;

/**
 * This is the model class for table "paciente".
 *
 * @property integer $idPaciente
 * @property string $p_nombre
 * @property string $s_nombre
 * @property string $p_apellido
 * @property string $s_apellido
 * @property integer $cedula
 * @property integer $edad
 * @property string $fecha_nacimiento
 * @property string $email
 * @property string $motivo_consulta
 * @property string $antecedentes
 * @property string $created_at
 * @property integer $cantidad_citas
 * @property integer $celular
 * @property integer $local
 * @property integer $Psiquiatra_idPsiquiatra
 * @property double $tarifa
 * @property double $deuda
 * @property string $seudonimo
 *
 * @property Cita[] $citas
 * @property Psiquiatra $psiquiatraIdPsiquiatra
 * @property Pago[] $pagos
 */
class Paciente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paciente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_nombre', 'p_apellido', 'cedula', 'edad', 'fecha_nacimiento', 'email', 'motivo_consulta', 'tarifa'], 'required'],
            [['cedula', 'edad', 'cantidad_citas', 'celular', 'local', 'Psiquiatra_idPsiquiatra'], 'integer'],
            [['fecha_nacimiento', 'created_at'], 'safe'],
            [['motivo_consulta', 'antecedentes'], 'string'],
            [['tarifa', 'deuda'], 'number'],
            [['p_nombre', 's_nombre', 'p_apellido', 's_apellido', 'email'], 'string', 'max' => 45],
            [['seudonimo'], 'string', 'max' => 20],
            [['cedula'], 'unique'],
            [['Psiquiatra_idPsiquiatra'], 'exist', 'skipOnError' => true, 'targetClass' => Psiquiatra::className(), 'targetAttribute' => ['Psiquiatra_idPsiquiatra' => 'idPsiquiatra']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPaciente' => 'Id Paciente',
            'p_nombre' => 'Nombre',
            's_nombre' => 'Segundo Nombre',
            'p_apellido' => 'Apellido',
            's_apellido' => 'Segundo Apellido',
            'cedula' => 'Cedula',
            'edad' => 'Edad',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'email' => 'Email',
            'motivo_consulta' => 'Motivo de la Consulta',
            'antecedentes' => 'Antecedentes',
            'created_at' => 'Fecha de Inicio',
            'cantidad_citas' => 'Cantidad de Citas',
            'celular' => 'Telefono Celular',
            'local' => 'Telefono Local',
            'Psiquiatra_idPsiquiatra' => 'Especialista Anterior',
            'tarifa' => 'Tarifa',
            'deuda' => 'Deuda',
            'seudonimo' => 'Seudonimo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitas()
    {
        return $this->hasMany(Cita::className(), ['Paciente_idPaciente' => 'idPaciente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPsiquiatraIdPsiquiatra()
    {
        return $this->hasOne(Psiquiatra::className(), ['idPsiquiatra' => 'Psiquiatra_idPsiquiatra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['Paciente_idPaciente' => 'idPaciente']);
    }

    //Obtiene la lista de psicologos para el combo box
    public static function getListaPsico(){
        $opciones = Psiquiatra::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'idPsiquiatra', 'nombre', 'apellido');
    }

    public function getPsiquiatra(){
        return $this->hasOne(Psiquiatra::className(), ['idPsiquiatra' => 'Psiquiatra_idPsiquiatra']);
    }

    //Busca el modelo del psiquiatra Seleccionado
    public function getModeloPsiquiatra($id){
        $idP = Psiquiatra::find()->where(['idPsiquiatra' => $id])->asArray()->one();
        return ArrayHelper::getValue($idP, 'idPsiquiatra');
    }

    //Mostrar solo el nombre del psiquiatra para el view
    public function getNombrePsiquiatra($id){
        $idP = Psiquiatra::find()->where(['idPsiquiatra' => $id])->asArray()->one();
        return ArrayHelper::getValue($idP, 'nombre');
    }

}
