<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\CitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Citas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cita-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Cita', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Ver Calendario', ['calendario'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'export'=>false,
        'rowOptions'=>function($model){
            if($model->show_up == 0){
                return ['class'=>'danger'];
            }else{
                return ['class'=>'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idCita',
            [
                'attribute'=>'Paciente_idPaciente',
                'value' => 'paciente.p_nombre'
            ],
            'fecha',
            'hora',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'show_up',
                'value' => 'ShowUp',
                'filter'=>array(0=>'No', 1 => 'Si'),
            ],
            [
                'attribute'=>'cancelado',
                'value'=>'Cancelo',
                'filter'=>array(0=>'No', 1 => 'Si'),
            ],
            // 'tarifa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
