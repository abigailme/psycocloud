<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\PagoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idFactura') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'deuda') ?>

    <?= $form->field($model, 'tipoPago_idtipoPago') ?>

    <?= $form->field($model, 'Paciente_idPaciente') ?>

    <?php // echo $form->field($model, 'Nombre') ?>

    <?php // echo $form->field($model, 'Descripcion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
