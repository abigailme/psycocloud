<?php

namespace frontend\models;

use Yii;
use frontend\models\Cita;
use frontend\models\Paciente;

class enviarRecordatorio extends \yii\db\ActiveRecord {

	$citas = Cita::find()->where(['show_up' => 0])->asArray()->all();

	usort($citas, function($a, $b) {
        return strtotime($a['fecha']) - strtotime($b['fecha']);
    });

	$arrayFechaFutura = array(date('Y'), date('m'), date('d'));

	$fechaFutura = implode("-", $arrayFechaFutura);

	$key = array_search($fechaFutura, array_column($citas, 'fecha'));

	if($key != false){

        for($i=$key; $i<count($citas); $i++){

        	$evento = $citas[$i];

        	$pacienteId = ArrayHelper::getValue($citas[$i], 'Paciente_idPaciente');

        	$paciente = Paciente::findOne($pacienteId);

        	Yii::$app->mailer->compose()
                ->setFrom('abigailmeloleon@gmail.com')
                ->setTo($paciente->email)
                ->setSubject('Recordatorio de Cita')
                ->setTextBody('Lo envio')
                ->setHtmlBody('<b>Recuerde su cita del dia: ' . $evento->fecha . ' a la hora ' . $evento->hora . ' </b>')
            ->send();


    	}
    }

}