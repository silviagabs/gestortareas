<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tareas */

$this->title = $model->id_tarea;
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['updatetareas', 'id' => $model->id_tarea], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['deletetareas', 'id' => $model->id_tarea], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quiere borrar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tarea',
            'nombre',
            'descripcion',
            'categoria',
            'prioridad',
            'fecha_inicio',
            'fecha_fin',
            'propietario',
        ],
    ]) ?>

</div>
