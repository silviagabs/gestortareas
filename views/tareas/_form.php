<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tareas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tareas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>

    <?=
            $form->field($model, 'prioridad')
            ->dropDownList([
                'BAJA' => 'BAJA', 'MEDIA' => 'MEDIA', 'ALTA' => 'ALTA', 'URGENTE' => 'URGENTE'
                    ], ['prompt' => 'Selecciona una Prioridad']);
    ?>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-5">
    <?=
    $form->field($model, 'fecha_inicio')->widget(
            DatePicker::className(), [
        // inline too, not bad
        'inline' => true,
                'language'=>'es',
        'dateFormat' => 'yyyy-MM-dd'
    ]);
    ?>
            </div>
<div class="col-lg-5">
    <?=
    $form->field($model, 'fecha_fin')->textInput()->widget(DatePicker::className(), [
        'inline' => true,
        'dateFormat' => 'yyyy-MM-dd'
    ]);
    ?>
    </div>
       </div>
    <?= $form->field($model, 'propietario')->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true]) ?>


    <div class="form-group">
<?= Html::submitButton('GUARDAR', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
