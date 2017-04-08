<?php
namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Paciente;
use frontend\controllers\CitaController;

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
            ['fecha', 'fechaAnterior', 'on'=> 'create'],
            ['hora', 'mismaCita', 'on'=> 'create'],
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
            'show_up' => 'Asistió',
            'cancelado' => 'Pagado',
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
    public static function getListaPaciente($id){
        $opciones = Paciente::find()->where(['idUsuario' => $id])->asArray()->all();
        for($i=0; $i<count($opciones); $i++){
            $items[$i]['id'] = $opciones[$i]['idPaciente'];
            $items[$i]['nombre'] = \Yii::$app->encrypter->decrypt($opciones[$i]['p_nombre']);
            $items[$i]['apellido'] = \Yii::$app->encrypter->decrypt($opciones[$i]['p_apellido']);
        }

        return ArrayHelper::map($items, 'id', 'nombre', 'apellido');
        
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
        return \Yii::$app->encrypter->decrypt(ArrayHelper::getValue($nombre, 'p_nombre', '-sin Nombre-'));
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

    //Valida que la cita no este hecha en un dia anterior al dia presente
    public function fechaAnterior(){
        $date = $this->fecha;
        $cita = explode('-', $date);
        $anoH=date('Y');
        $mesH=date('m');
        $diaH=date('d');

        if($cita[0]<$anoH){
            $this->addError('fecha', 'El año elegido ya expiro');
        }else{
            if($cita[1]<$mesH){
                $this->addError('fecha', 'El mes elegido ya expiro');
            }
            else{
                if($cita[2]<$diaH && $cita[1] == $mesH){
                    $this->addError('fecha', 'La fecha elegida ya expiro');
                }
            }
        }
    }

    //Valida que la cita no este a la misma hora que otra
    public function mismaCita(){        

        $eventos = Cita::find()->joinWith('paciente')->where(['paciente.idUsuario' => Yii::$app->user->identity->id, 'show_up' => 0])->asArray()->all();

        usort($eventos, function($a, $b) {
            return strtotime($a['fecha']) - strtotime($b['fecha']);
        });

        $key = array_search($this->fecha, array_column($eventos, 'fecha'));
       
        if($key != false){
         //   $this->addError('hora', 'A esta hora ya esta agendado un paciente');
            for($i=$key; $i<count($eventos); $i++){
                $horaC = ArrayHelper::getValue($eventos[$i], 'hora');
                if($horaC == $this->hora){
                $this->addError('hora', 'A esta hora ya esta agendado un paciente');
                }
            }
        }

    }

    //cambia los valores de la cita
    public function cambiarCita($id){
        $cita = Cita::findOne($id);
        $cita->show_up = 1;
        $cita->cancelado = 1;
    }

    /**
    *Obtiene los pacientes dado un psicologo
    */
    public function pacientesConCita($id){
        $paciente = Paciente::find()->where(['idUsuario' => $id])->asArray()->all();
        return $paciente;
    }

    static function cambiaIdPaciente($idCita, $paciente){
        CitaController::actionCambiaCitaPaciente($idCita, $paciente);
        
    }

   

}
