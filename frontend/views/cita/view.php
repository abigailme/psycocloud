<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cita */

$this->title = $model->idCita;
$this->params['breadcrumbs'][] = ['label' => 'Citas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cita-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCita',
            'fecha',
            'hora',
            ['attribute' => 'show_up',
            'value' => $model->getShowUp()], 
            ['attribute'=>'cancelado',
            'value' => $model->getCancelo()],
            ['attribute'=>'Paciente_idPaciente',
            'format'=>'raw',
            'value' => Html::a($model->getPacienteNombre($model->Paciente_idPaciente), ['paciente/view', 'id'=>$model->getModeloPaciente($model->Paciente_idPaciente)])],
            'tarifa',
        ],
    ]) ?>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->idCita], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <p>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idCita], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
