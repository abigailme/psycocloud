<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Paciente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-paciente">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-4">
        <h3>Crear Paciente</h3>
        <p> <?= Html::a('Crear Paciente', ['/paciente/create'], ['class' => 'btn btn-primary btn-lg btn-block']) ?> </p>
    </div>
    <div class="col-lg-4">
        <h3>Ver Pacientes</h3>
        <p> <?= Html::a('Ver Pacientes', ['/paciente/index'], ['class' => 'btn btn-primary btn-lg btn-block']) ?> </p>
    </div>
</div>
