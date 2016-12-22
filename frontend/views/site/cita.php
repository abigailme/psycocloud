<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cita';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cita">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-4">
        <h3>Crear Cita</h3>
        <p> <?= Html::a('Crear Cita', ['/cita/create'], ['class' => 'btn btn-primary btn-lg btn-block']) ?> </p>
    </div>
    <div class="col-lg-4">
        <h3>Ver Citas</h3>
        <p> <?= Html::a('Ver Citas', ['/cita/index'], ['class' => 'btn btn-primary btn-lg btn-block']) ?> </p>
    </div>
</div>