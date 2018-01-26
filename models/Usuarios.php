<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $username
 * @property string $authKey
 * @property int $activo
 * @property string $password
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'username'], 'required'],
            [['activo'], 'integer'],
            [['nombre', 'apellidos', 'username', 'authKey', 'password'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'email' => 'Email',
            'username' => 'Username',
            'authKey' => 'Auth Key',
            'activo' => 'Activo',
            'password' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }
}
