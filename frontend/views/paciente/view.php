<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model frontend\models\Paciente */

$this->title = $model->p_nombre . ' ' . $model->p_apellido;
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paciente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPaciente',
            'seudonimo',
            'p_nombre',
            's_nombre',
            'p_apellido',
            's_apellido',
            'cedula',
            'edad',
            'fecha_nacimiento',
            'email:email',
            'motivo_consulta:ntext',
            'antecedentes:ntext',
            'created_at',
            'cantidad_citas',
            'celular',
            'local',
            [
                'attribute'=>'Psiquiatra_idPsiquiatra',
                'format'=>'raw',
                'value' => Html::a($model->getNombrePsiquiatra($model->Psiquiatra_idPsiquiatra), ['psiquiatra/view', 'id' => $model->getModeloPsiquiatra($model->Psiquiatra_idPsiquiatra)]) //Psiquiatra::findOne($model->Psiquiatra_idPsiquiatra)->nombre
            ],
            'tarifa',
            'deuda',          
        ],
    ]) ?>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->idPaciente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idPaciente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar este paciente?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <p>
        <?= Html::a('Crear Cita', ['cita/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>


</div>

