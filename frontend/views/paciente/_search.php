<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\PacienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paciente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPaciente') ?>

    <?= $form->field($model, 'p_nombre') ?>

    <?= $form->field($model, 's_nombre') ?>

    <?= $form->field($model, 'p_apellido') ?>

    <?= $form->field($model, 's_apellido') ?>

    <?php // echo $form->field($model, 'cedula') ?>

    <?php // echo $form->field($model, 'edad') ?>

    <?php // echo $form->field($model, 'fecha_nacimiento') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'motivo_consulta') ?>

    <?php // echo $form->field($model, 'antecedentes') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'cantidad_citas') ?>

    <?php // echo $form->field($model, 'celular') ?>

    <?php // echo $form->field($model, 'local') ?>

    <?php // echo $form->field($model, 'Psiquiatra_idPsiquiatra') ?>

    <?php // echo $form->field($model, 'tarifa') ?>

    <?php // echo $form->field($model, 'deuda') ?>

    <?php // echo $form->field($model, 'seudonimo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
