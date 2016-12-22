<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pago */
/* @var $form kartik\form\ActiveForm */
?>

<div class="pago-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation'=>false,]); ?>

    <?= $form->field($model, 'Paciente_idPaciente')->textInput(['readOnly'=>true]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true, 'readOnly'=> true]) ?>

    <?= $form->field($model, 'monto', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']]]])->widget(MaskMoney::classname(),[
                    'pluginOptions' => [
                        'suffix' => ' Bs',
                        'allaowNegative' => false
                        ]
                    ]) 
    ?>

    <?= $form->field($model, 'deuda', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']]]])->textInput(['readOnly'=>true]) ?>

    <?= $form->field($model, 'tipoPago_idtipoPago')->dropDownList(array('prompt' => 'Seleccione un tipo de pago', 1 => 'Efectivo', 2 => 'Transferencia')); ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true, 'placeholder'=>'Ingrese el numero de la transferencia']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS

$(document).ready(function(){
   $('div.form-group.field-pago-descripcion').hide();
   $("select[name='Pago\\[tipoPago_idtipoPago\\]']").change(function(){
    if($(this).val()==2){
        $('div.form-group.field-pago-descripcion').show();
    }
    else{
        $('div.form-group.field-pago-descripcion').hide();
    }
   })

});

JS;

$this->registerJs($script);
