<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Paciente */

$this->title = 'Crear Paciente';
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paciente-create" style="padding-left: 200px; padding-right: 200px">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
