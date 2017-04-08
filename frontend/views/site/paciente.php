<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PacienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buscar Pacientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paciente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Paciente', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idPaciente',
            'seudonimo',
            'p_nombre',
            's_nombre',
            'p_apellido',
            's_apellido',
            'cedula',
            // 'edad',
            // 'fecha_nacimiento',
            // 'email:email',
            // 'motivo_consulta:ntext',
            // 'antecedentes:ntext',
            // 'created_at',
            // 'cantidad_citas',
            // 'celular',
            // 'local',
            // 'Psiquiatra_idPsiquiatra',
            // 'tarifa',
            // 'deuda',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
