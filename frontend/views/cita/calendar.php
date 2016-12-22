<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Cita */

$this->title = 'Crear Cita';

?>
<div class="cita-calendar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>