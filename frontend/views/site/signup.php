<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Registro de Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Ingrese los datos del psicólogo a registrar: </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'enableClientValidation' => false,
            ]); ?>

                <?= $form->field($model, 'nombre')->textInput() ?>

                <?= $form->field($model, 'apellido')->textInput() ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nombre de Usuario') ?>

                <?= $form->field($model, 'email', [
                        'addon' => ['prepend'=>['content'=>'@']]])->widget(\yii\widgets\MaskedInput::classname(),[
                    'name' => 'input-36',
                    'clientOptions'=> [
                        'alias' => 'email'
                ]])?>

                <?= $form->field($model, 'telefono', [
                    'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]])->widget(\yii\widgets\MaskedInput::classname(), [
                    'name' => 'input-5',
                    'mask' => ['(999)-999-9999' , '(9999)-999-9999'],
                    'clientOptions' => [
                        'removeMaskOnSubmit' => true,
                    ]
                ])?>

                <?= $form->field($model, 'direccion')->textarea(['rows' => 2]) ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>

                <?= $form->field($model, 'role')->dropDownList(array('prompt'=>'Seleccione Un Role', 1=>'Administrador', 2=>'Psicologo'))->label('Rol') ?>

                <div class="form-group">
                    <?= Html::submitButton('Aceptar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
