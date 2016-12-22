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
        'enableClientValidation'=>false,
        ]); ?>

    <?= $form->field($model, 'Psiquiatra_idPsiquiatra', [
        'addon'=>[
            'append' => [
                'content' => Html::a('Agregar', '#', [
                'id'=> 'activity-index-link',
                'class' => 'btn btn-success',
                'data-toggle' => 'modal',
                'data-target' => '#modal',
                'data-url' => Url::to(['psiquiatra/create']),
                'data-pjax' => '0',]),
            'asButton'=> true,]]])->dropDownList($model->listaPsico, ['prompt'=>'Seleccione un Especialista']) 
    ?>

    <?= $form->field($model, 'p_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seudonimo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedula')->textInput() ?>

    <?= $form->field($model, 'edad')->textInput() ?>

    <?= $form->field($model, 'fecha_nacimiento')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
    'ajaxConversion' => true,
    'options' => [
        'pluginOptions' => [
            'autoclose' => true]]
    ])->label('Escoja la Fecha de Nacimiento') ?>

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

    <?= $form->field($model, 'created_at')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
    'ajaxConversion' => true,
    'options' => [
        'pluginOptions' => [
            'autoclose' => true]]
    ])->label('Escoja la Fecha de Inicio del paciente') ?>

    <!-- <?= $form->field($model, 'cantidad_citas')->textInput() ?> -->

    <?= $form->field($model, 'tarifa', [
            'addon' => [
                'prepend' => ['content' => 'Bs', 'options' => ['class' => 'alert-success']]]])->widget(MaskMoney::classname(),[
                    'pluginOptions' => [
                        'suffix' => ' Bs',
                        'allaowNegative' => false]]) ?>

    <!--<?= $form->field($model, 'deuda')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
        $this->registerJs(
        "
            $(document).on('click', '#activity-index-link', (function() {
            $.get(
                $(this).data('url'),
                function (data) {
                    $('.modal-body').html(data);
                    $('#modal').modal();
                }
        );
        }));"
    ); ?>

    <?php
        Modal::begin([
            'id' => 'modal',
            'header' => '<h4 class="modal-title">Crear Especialista</h4>',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>',
    ]);
     
    echo "<div class='well'></div>";
     
    Modal::end();
    ?>
    
</div>
