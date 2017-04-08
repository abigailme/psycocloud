<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Usuario', ['site/signup'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            [
                'attribute' => 'username',
                'label' => 'Nombre de Usuario',
            ],
            'nombre',
            'apellido',
            'telefono',
         //   'direccion',
   //         'auth_key',
     //       'password_hash',
       //     'password_reset_token',
             'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',
             [
                'attribute' => 'role',
                'label' => 'Rol',
                'value' => 'Role',
                'filter' => array(1=>'Administrador', 2=>'Psicologo'),
            ],
             
             
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
