<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tareas]].
 *
 * @see Tareas
 */
class TareasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tareas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tareas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
