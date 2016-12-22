<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pago */

$this->title = 'Update Pago: ' . $model->idFactura;
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFactura, 'url' => ['view', 'idFactura' => $model->idFactura, 'Paciente_idPaciente' => $model->Paciente_idPaciente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
