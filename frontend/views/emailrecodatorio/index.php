<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\EmailrecodatorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emailrecodatorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailrecodatorio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Emailrecodatorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha',
            'enviado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
