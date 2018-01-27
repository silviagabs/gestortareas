<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TAREAS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_tarea',
            [

                'attribute' => 'nombre',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a(strtoupper($model->nombre), ['admin/view', 'id' => $model->id_tarea]);
                }
                    ],
            'descripcion',
            'categoria',
            'prioridad',
            'fecha_inicio',
            'fecha_fin',
            'propietario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
