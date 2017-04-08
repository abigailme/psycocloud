<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\money\MaskMoney;
use kartik\dialog\Dialog;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pago */
/* @var $form kartik\form\ActiveForm */
?>

<div class="pago-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation'=>false,]); ?>

    <?= $form->field($model, 'Paciente_idPaciente')->textInput(['readOnly'=>true]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true, 'readOnly'=> true]) ?>

    <?= $form->field($model, 'tipoPago_idtipoPago')->dropDownList(array('prompt' => 'Seleccione un tipo de pago', 1 => 'Efectivo', 2 => 'Transferencia')); 
    ?>

    <?= $form->field($model, 'deuda', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']]
            ]
        ])->textInput(['readOnly'=>true]) 
    ?>

    <?= $form->field($model, 'monto', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']]]])->textInput()
    ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true, 'placeholder'=>'Ingrese el numero de la transferencia']) ?>

    <?= $form->field($model, 'email')->checkbox()->label('Enviar correo electrónico para notificar pago. ')
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  
    <?php ActiveForm::end(); ?>

</div>



<?php

$script = <<<JS

$(document).ready(function(){
    $('div.form-group.field-pago-descripcion').hide();
    $('div.form-group.field-pago-paciente_idpaciente.required').hide();
    $('div.form-group.field-pago-deuda').hide();
    $('div.form-group.field-pago-monto').hide();    

});

$("select[name='Pago\\[tipoPago_idtipoPago\\]']").change(function(){

        var paciente = document.getElementById("pago-paciente_idpaciente").value;
        $('div.form-group.field-pago-deuda').show();
        $('div.form-group.field-pago-monto').show();

        $.get('index.php?r=cita/get-cita', {id : paciente }, function(data){
            var citas = $.parseJSON(data);
            
            for(var i=0; i<citas.length; i++){
                var checkbox = document.createElement('input');
                checkbox.type = "checkbox";
                checkbox.name = "name";
                checkbox.id= citas[i].idCita;
                var label = document.createElement('label')
                label.htmlFor = citas[i].idCita;
                label.appendChild(document.createTextNode('Cita '+citas[i].idCita+' '));
                var div = document.createElement('div');
                div.appendChild(label);
                div.appendChild(checkbox);
                document.querySelector(".form-group.field-pago-deuda").appendChild(div);
            }
            
        });

        if($(this).val()==2){
            $('div.form-group.field-pago-descripcion').show();
        }
        else{
            $('div.form-group.field-pago-descripcion').hide();
        }
});

$('button.btn.btn-success').on('click', function(){

    $("input:checkbox:checked").each(function() {
        if($(this).attr('id') != 'activity-index-link'){
            var idCita = $(this).attr('id'); 
            $.get('index.php?r=cita/cambia-cita', {id : idCita}, function(data){
            });
        }
    });  

});



JS;

$this->registerJs($script);

echo Dialog::widget([
    'libName' => 'krajeeDialogCust', // a custom lib name
    'options' => [  // customized BootstrapDialog options
        'size' => Dialog::SIZE_LARGE, // large dialog text
        'type' => Dialog::TYPE_INFO, // bootstrap contextual color
        'title' => 'Información',
        'message' => 'El siguiente mensaje será enviado por correo electrónico ',
        'buttons' => [
            [
                'id' => 'cust-btn-1',
                'label' => 'OK',
                'icon' => Dialog::ICON_OK,
                'action' => new JsExpression("function(dialog) {
                    dialog.close();
                }")
            ],
        ]
    ]
]);
 
// javascript for triggering the dialogs
$js = <<< JS
$("#pago-email").on("click", function() {
    
    var paciente = document.getElementById("pago-paciente_idpaciente").value;
    var monto = document.getElementById("pago-monto").value;
    
    $.get('index.php?r=paciente/get-tarifa', {id : paciente}, function(data){
        var nombre = $.parseJSON(data);

        krajeeDialogCust.dialog(
            "El siguiente mensaje sera enviado al paciente " + nombre.p_nombre + " " + nombre.p_apellido + ": <br/><br/> Estimado Sr(a).<br/>Gracias por su pago, he recibido la cantidad de: " + monto + " BsF." ,
            function(result) {
                // do something
            }
        );
        
    });
    
});
JS;
 
// register your javascript
$this->registerJs($js);

?>
