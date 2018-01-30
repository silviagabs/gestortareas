<?php

use yii\helpers\Html;
use yii\grid\GridView;
use sjaakp\gcharts\ColumnChart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

if(Yii::$app->user->identity->admin){
    echo " <h1 class='text-center'>BIENVENIDO ADMINISTRADOR </h1>";
}
else{
$this->title = 'Mis Tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Tareas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
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
            //'propietario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
}?>
</div>

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
        'title' => 'ESTADO de las TAREAS',
        
    ],
]) ?>
    </div> 
