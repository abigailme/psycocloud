<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Psiquiatra */

$this->title = 'Crear Especialista';
$this->params['breadcrumbs'][] = ['label' => 'Psiquiatras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psiquiatra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
