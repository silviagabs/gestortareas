<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'USUARIOS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [

                'attribute' => 'username',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a(strtoupper($model->username), ['tareas/view', 'id' => $model->id]);
                }
                    ],
            'nombre',
            'apellidos',
            'email',
            'activo',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
