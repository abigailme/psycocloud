<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Psiquiatra */

$this->title = 'Update Psiquiatra: ' . $model->idPsiquiatra;
$this->params['breadcrumbs'][] = ['label' => 'Psiquiatras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPsiquiatra, 'url' => ['view', 'id' => $model->idPsiquiatra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="psiquiatra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
