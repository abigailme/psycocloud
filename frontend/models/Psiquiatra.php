<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "psiquiatra".
 *
 * @property integer $idPsiquiatra
 * @property string $nombre
 * @property string $apellido
 * @property integer $telefono
 * @property string $email
 * @property integer $idCreador
 *
 * @property Paciente[] $pacientes
 */
class Psiquiatra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'psiquiatra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['telefono', 'idCreador'], 'integer'],
            [['nombre', 'apellido'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 100],
            ['nombre', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['apellido', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPsiquiatra' => 'Id Psiquiatra',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'idCreador' => 'Id Creador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['Psiquiatra_idPsiquiatra' => 'idPsiquiatra']);
    }
}
