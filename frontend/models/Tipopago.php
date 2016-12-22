<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipopago".
 *
 * @property integer $idtipoPago
 * @property string $descripcion
 *
 * @property Pago[] $pagos
 */
class Tipopago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipopago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipoPago' => 'Idtipo Pago',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['tipoPago_idtipoPago' => 'idtipoPago']);
    }
}
