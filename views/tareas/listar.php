<?php

use yii\helpers\Html;
use yii\grid\GridView;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\ColumnChart;
use sjaakp\timeline\Timeline;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis Tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--
    <?
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_tarea',
            [
                'attribute' => 'nombre',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->nombre, ['tareas/view', 'id' => $model->id_tarea]);
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
    ]);
    ?>
-->

<div>
        <?= ColumnChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre:string',
        'fecha_inicio:date',
        'fecha_fin:date'
    ],
    'options' => [
        'title' => 'TAREAS'
    ],
]) ?>
    </div> 
