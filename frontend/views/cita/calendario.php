<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

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
        <?= Html::a('Crear Cita', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
    ));?>


    <?php
        $this->registerJs(
            "$(document).on('click','.fc-day', (function(){
                var date = $(this).attr('data-date');


                $.get('index.php?r=cita/calendar', {'date':date}, function(data){
                    eventOverlap: false;
                    $('.modal-body').html(data);
                    $('#modal').modal();
                });
            }));"
    ); ?>

    <?php
        Modal::begin([
            'id' => 'modal',
            'header' => '<h4 class="modal-title">Crear Cita</h4>',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

</div>
