<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pago */

$this->title = $model->idFactura;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idFactura',
            'monto',
            'deuda',
            'tipoPago_idtipoPago',
            'Paciente_idPaciente',
            'Nombre',
            'Descripcion',
        ],
    ]) ?>

    <p>
        <?= Html::a('Editar', ['update', 'idFactura' => $model->idFactura, 'Paciente_idPaciente' => $model->Paciente_idPaciente], [
        'class' => 'btn btn-primary']) ?>
        <?= Html::a('Volver', ['/cita/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <p>
        <?= Html::a('Eliminar', ['delete', 'idFactura' => $model->idFactura, 'Paciente_idPaciente' => $model->Paciente_idPaciente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
