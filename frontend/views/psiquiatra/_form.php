<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Psiquiatra */
/* @var $form kartik\form\ActiveForm */
?>

<div class="psiquiatra-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation'=>false,
        ]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono', [
        'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]])->widget(\yii\widgets\MaskedInput::classname(), [
        'name' => 'input-5',
        'mask' => ['(999)-999-9999' , '(9999)-999-9999'],
        'clientOptions' => [
            'removeMaskOnSubmit' => true,
        ]
    ])?>

    <?= $form->field($model, 'email', [
            'addon' => ['prepend'=>['content'=>'@']]])->widget(\yii\widgets\MaskedInput::classname(),[
        'name' => 'input-36',
        'clientOptions'=> [
            'alias' => 'email'
    ]])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
