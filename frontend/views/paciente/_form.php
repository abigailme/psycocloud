<?php

use yii\helpers\Html;
use kartik\datecontrol\DateControl;
use kartik\form\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model frontend\models\Paciente */
/* @var $form kartik\form\ActiveForm */
?>

<div class="paciente-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation'=>true,
        ]); ?>

    <?= $form->field($model, 'Psiquiatra_idPsiquiatra', [
        'addon'=>[
            'append' => [
                'content' => Html::a('Agregar', '#', [
                'id'=> 'activity-index-link',
                'class' => 'btn btn-blue',
                'data-toggle' => 'modal',
                'data-target' => '#modal',
                'data-url' => Url::to(['psiquiatra/create']),
                'data-pjax' => '0',]),
            'asButton'=> true,]]])->dropDownList($model->getListaPsico(Yii::$app->user->identity->id), ['prompt'=>'Seleccione un Especialista']) 
    ?>

    <?= $form->field($model, 'p_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seudonimo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedula')->textInput() ?>

    <?= $form->field($model, 'fecha_nacimiento')->widget(\yii\widgets\MaskedInput::classname(), [
        'name' => 'input-31',
        'clientOptions' => ['alias' =>  'dd-mm-yyyy']
    ])
    ?>

    <?= $form->field($model, 'edad')->textInput(['readOnly' => true]) ?>

    <?= $form->field($model, 'nombre_padre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'nombre_madre')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'email', [
            'addon' => ['prepend'=>['content'=>'@']]])->widget(\yii\widgets\MaskedInput::classname(),[
        'name' => 'input-36',
        'clientOptions'=> [
            'alias' => 'email'
    ]])?>

    <?= $form->field($model, 'local', [
        'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]])->widget(\yii\widgets\MaskedInput::classname(), [
        'name' => 'input-5',
        'mask' => ['(999)-999-9999' , '(9999)-999-9999'],
        'clientOptions' => [
            'removeMaskOnSubmit' => true,
        ]
    ])?>

    <?= $form->field($model, 'celular', [
        'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]])->widget(\yii\widgets\MaskedInput::classname(), [
        'name' => 'input-5',
        'mask' => ['(999)-999-9999' , '(9999)-999-9999'],
        'clientOptions' => [
            'removeMaskOnSubmit' => true,
        ]
    ])?>

    <?= $form->field($model, 'motivo_consulta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'antecedentes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'es',
    'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <!-- <?= $form->field($model, 'cantidad_citas')->textInput() ?> -->

    <?= $form->field($model, 'tarifa', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']]]])->textInput()?>

    <!--<?= $form->field($model, 'deuda')->textInput() ?>-->

    <?= $form->field($model, 'idUsuario')->textInput(['value'=> Yii::$app->user->identity->id]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Aceptar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
        $this->registerJs(
        "
        $(document).ready(function(){
            $('div.form-group.field-paciente-idusuario.required').hide();
            $('div.form-group.field-paciente-nombre_padre').hide();
            $('div.form-group.field-paciente-nombre_madre').hide();
        });

        $(document).on('click', '#activity-index-link', (function() {
            $.get(
                $(this).data('url'),
                function (data) {
                    $('.modal-body').html(data);
                    $('#modal').modal();
                    $('#modal').show();
                }
            );
        }));

        $('#paciente-fecha_nacimiento').change(function(){
            var fechaN = $(this).val();
            $.get('index.php?r=paciente/get-edad', {fecha : fechaN }, function(data){
                var data = $.parseJSON(data);
                $('#paciente-edad').attr('value',data); 
                if(data<18){
                    $('div.form-group.field-paciente-nombre_padre').show();
                    $('div.form-group.field-paciente-nombre_madre').show();
                }
            }); 
        });

        "
    ); ?>

    <?php
        Modal::begin([
            'id' => 'modal',
            'class' => 'modal-content modal-popup',
            'header' => '<h4 class="modal-title">Crear Especialista</h4>',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    ]);
     
    echo "<div class='well'></div>";
     
    Modal::end();

 /*   Modal::begin([
        'id' => 'modal',
        'closeButton' => [
            'label' => 'Close modal',
            'tag' => 'span'
        ],
        'toggleButton' => [
            'label' => 'Open modal'
        ],
        'modalType' => Modal::TYPE_BOTTOM_SHEET,
    ]);

    echo 'Say hello...';

    Modal::end();*/
    ?>
    
</div>
