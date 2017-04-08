<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "emailrecodatorio".
 *
 * @property integer $id
 * @property string $fecha
 * @property integer $enviado
 */
class Emailrecodatorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emailrecodatorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'enviado'], 'required'],
            [['fecha'], 'safe'],
            [['enviado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'enviado' => 'Enviado',
        ];
    }

    /**
     * Busca si un recordatorio fue envio en la fecha dada
    */
    static function buscarRecordatorio(){

        
        $emails = Emailrecodatorio::find()->asArray()->all();

        usort($emails, function($a, $b) {
            return strtotime($a['fecha']) - strtotime($b['fecha']);
        });

        $anoH=date('Y');
        $mesH=date('m');
        $diaH=date('d');
        $arrayFecha = array($anoH, $mesH, $diaH);
        $fechaActual = implode('-', $arrayFecha);

        $key = array_search($fechaActual, array_column($emails, 'fecha'));
       
        $consiguio = 0;

        if($key != false){
            return $consiguio = 1;
        }

        return $consiguio;

    }
}
