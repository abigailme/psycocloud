<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Paciente */

$this->title = 'Editar Paciente: ' . $model->p_nombre . ' ' . $model->p_apellido;
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPaciente, 'url' => ['view', 'id' => $model->idPaciente]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="paciente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
