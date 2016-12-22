<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\time\TimePicker;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cita */
/* @var $form kartik\form\ActiveForm */
?>

<div class="cita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Paciente_idPaciente')->dropDownList($model->listaPaciente, ['prompt'=>'Seleccione un Paciente', 'id' => 'paciente']) ?>

    <?= $form->field($model, 'fecha')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
    'ajaxConversion' => true,
    'options' => [
        'pluginOptions' => [
            'autoclose' => true]]
    ])->label('Escoja la Fecha de la Cita') ?>

    <?= $form->field($model, 'hora')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_TIME,
        ]) ?>

    <?= $form->field($model, 'show_up')->checkbox() ?>

    <?= $form->field($model, 'cancelado')->checkbox([
                'id'=> 'activity-index-link',
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-target' => '#modal',
                'data-url' => Url::to(['pago/create']),
                'data-pjax' => '0',]) ?>

    <?= $form->field($model, 'tarifa', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']],
                'append' => [
                'content' => Html::a('Editar', ['paciente/update', 'id' => $model->getModeloPaciente($model->Paciente_idPaciente)], ['class' => 'btn btn-success']),
            'asButton'=> true,]]])->textInput(['readonly'=>true])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS

$('#paciente').change(function(){
    var paciente = $(this).val();
    $.get('index.php?r=paciente/get-tarifa', {id : paciente }, function(data){
        var data = $.parseJSON(data);
        $('#cita-tarifa').attr('value',data.tarifa);    
    });

    $(document).on('change', '#activity-index-link', (function() {
    if(this.checked){
        $.get($(this).data('url'),
                    function (data) {
                        $('.modal-body').html(data);
                        $.get('index.php?r=paciente/get-tarifa', {id : paciente}, function(data){
                            var nombre = $.parseJSON(data);
                            $('#pago-paciente_idpaciente').attr('value', nombre.idPaciente); 
                            $('#pago-deuda').attr('value', nombre.deuda);
                            $('#pago-nombre').attr('value', nombre.p_nombre);
                        });
                        $('#modal').modal();
                    }
        );
    };
}));
});


$('#activity-index-link').change(function() {
    if(document.getElementById("activity-index-link").checked){
        var e = document.getElementById("paciente");
        var paciente = e.options[e.selectedIndex].value;
            $.get($(this).data('url'),
                function (data) {
                    $('.modal-body').html(data);
                    $.get('index.php?r=paciente/get-tarifa', {id : paciente}, function(data){
                        var nombre = $.parseJSON(data);
                        $('#pago-paciente_idpaciente').attr('value', nombre.idPaciente);  
                        $('#pago-deuda').attr('value', nombre.deuda);
                        $('#pago-nombre').attr('value', nombre.p_nombre);
                    });
                    $('#modal').modal();
                }
        );
    };

});

JS;

$this->registerJs($script);

Modal::begin([
    'id' => 'modal',
    'header' => '<h4 class="modal-title">Registrar Pago</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
]);
     
echo "<div class='well'></div>";
     
Modal::end();

?>
