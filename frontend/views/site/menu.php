<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\dialog\Dialog;
use yii\web\JsExpression;

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p> </p>
    
    <div class="row">
        <div class="col-lg-4">
            <h3>Pacientes:</h3>
            <p>
                <?= Html::a('Crear Paciente', ['/paciente/create'], ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </p>
            <p>
                <?= Html::a('Ver Paciente', ['/paciente/index'], ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </p>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="col-lg-4">
            <h3>Citas:</h3>
            <p>
                <?= Html::a('Crear Cita', ['/cita/create'], ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </p>
            <p>
                <?= Html::a('Ver Cita', ['/cita/index'], ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </p>
            <p>
                <?= Html::a('Ver Calendario', ['/cita/calendario'], ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </p>
        </div>
       
    </div>  
</div>

