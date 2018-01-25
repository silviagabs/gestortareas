<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tareas".
 *
 * @property int $id_tarea
 * @property string $nombre
 * @property string $descripcion
 * @property string $categoria
 * @property string $prioridad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $propietario
 *
 * @property Usuarios $propietario0
 */
class Tareas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tareas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'categoria', 'prioridad', 'fecha_inicio', 'fecha_fin', 'propietario'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['nombre', 'descripcion', 'categoria', 'prioridad', 'propietario'], 'string', 'max' => 255],
            [['propietario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['propietario' => 'username']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tarea' => 'Id Tarea',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'categoria' => 'Categoria',
            'prioridad' => 'Prioridad',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'propietario' => 'Propietario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropietario0()
    {
        return $this->hasOne(Usuarios::className(), ['username' => 'propietario']);
    }

    /**
     * @inheritdoc
     * @return TareasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TareasQuery(get_called_class());
    }
}
