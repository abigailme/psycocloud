<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Psiquiatra */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Especialista', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psiquiatra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPsiquiatra',
            'nombre',
            'apellido',
            'telefono',
            'email:email',
        ],
    ]) ?>


    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->idPsiquiatra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idPsiquiatra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>
        <?= Html::a('Volver', ['paciente/index'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
