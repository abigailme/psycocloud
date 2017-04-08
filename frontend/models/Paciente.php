<?php
namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Psiquiatra;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "paciente".
 *
 * @property integer $idPaciente
 * @property string $p_nombre
 * @property string $s_nombre
 * @property string $p_apellido
 * @property string $s_apellido
 * @property string $cedula
 * @property integer $edad
 * @property string $fecha_nacimiento
 * @property string $email
 * @property string $motivo_consulta
 * @property string $antecedentes
 * @property string $created_at
 * @property integer $cantidad_citas
 * @property string $celular
 * @property string $local
 * @property integer $Psiquiatra_idPsiquiatra
 * @property double $tarifa
 * @property double $deuda
 * @property string $seudonimo
 * @property integer $idUsuario
 * @property string $nombre_padre
 * @property string $nombre_madre
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
     * Cambia el formato de la fecha
    **/
    public function behaviors(){
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_INSERT => 'fecha_nacimiento',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'fecha_nacimiento',
                    
                ],
                'value' => function ($event) {
                    return date('Y-m-d H:i:s', strtotime($this->fecha_nacimiento));
                },
            ],
            'encryption' => [
                'class' => '\nickcv\encrypter\behaviors\EncryptionBehavior',
                'attributes' => [
                    'p_nombre', 's_nombre', 'p_apellido', 's_apellido', 'cedula', 'email', 'motivo_consulta', 'antecedentes', 'celular', 'local', 'seudonimo', 'nombre_padre', 'nombre_madre',
                ],
            ],   
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_nombre', 'p_apellido', 'cedula', 'edad', 'fecha_nacimiento', 'email', 'motivo_consulta', 'tarifa', 'idUsuario'], 'required'],
            ['p_nombre', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['s_nombre', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['p_apellido', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['s_apellido', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['nombre_madre', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['nombre_padre', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            [['cedula', 'edad', 'cantidad_citas', 'Psiquiatra_idPsiquiatra', 'idUsuario',], 'integer', 'min'=>1],
            [['fecha_nacimiento', 'created_at'], 'safe'],
            [['motivo_consulta', 'antecedentes'], 'string'],
            ['deuda', 'number'],
            ['tarifa', 'number', 'min' => 1],
            ['email', 'email'],
            [['p_nombre', 's_nombre', 'p_apellido', 's_apellido', 'email'], 'string', 'max' => 45],
            [['seudonimo'], 'string', 'max' => 20],
            [['celular', 'local'], 'string', 'max' => 15],
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
            'idUsuario' => 'idUsuario',
            'nombre_padre' => 'Nombre del Padre',
            'nombre_madre' => 'Nombre de la Madre',
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
    public static function getListaPsico($id){
        $opciones = Psiquiatra::find()->where(['idCreador'=>$id])->asArray()->all();
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

    //Calcular edad
    static function calcularEdad($fecha){
        $fechaNacimiento = explode("-", $fecha);
        $diaN = $fechaNacimiento[0];
        $diaH = date("d");
        $mesN = $fechaNacimiento[1];
        $mesH = date("m");
        $anoN = $fechaNacimiento[2];
        $anoH = date("Y");
        $edad = $anoH - $anoN;

        if($mesH < $mesN){
            $edad = $edad - 1;
        }
        elseif ($mesH == $mesN && $diaH < $diaN) {
            $edad = $edad -1;
        }

        return $edad;
    }

    public function getCitasPaciente($id, $paciente){
        $citas = Cita::find()->where(['Paciente_idPaciente' => $id])->asArray()->all();
        for($i=0; $i<count($citas); $i++){
            $idCita = $citas[$i]['idCita'];
            $model = Cita::cambiaIdPaciente($idCita, $paciente);
        }
    }


}
