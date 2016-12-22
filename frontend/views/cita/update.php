<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cita */

$this->title = 'Editar Cita: ' . $model->idCita;
$this->params['breadcrumbs'][] = ['label' => 'Citas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCita, 'url' => ['view', 'id' => $model->idCita]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="cita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
