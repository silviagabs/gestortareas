<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'FORMULARIO de CONTACTO';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">


    <?php if (Yii::$app->session->hasFlash('Correo')) { ?>

        <div class="alert alert-success">
            Gracias por poneros en contacto con nosotros
        </div>

    <?php } else { ?>



        <div class="row">
            <div class="col-lg-5">
                <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
                <p>
                    Si tienes dudas o quieres proponer alguna sugerencia. Rellena este formulario.
                </p>

                <?php
                $form = ActiveForm::begin(['id' => 'contact-form']);

                if (!Yii::$app->user->isGuest) {
                    echo $form->field($model, 'name')->textInput(['value' => $model->username, 'readonly'=>true]);
                } else {
                    echo $form->field($model, 'name')->textInput(['autofocus' => true]);
                }
                ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?=
                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])
                ?>

                <div class="form-group">
    <?= Html::submitButton('ENVIAR', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

    <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-offset-2 col-lg-5">
                <h2 class="text-center">ACADEMIA ALPE</h2>
                <div>
                    <?php
                    echo yii2mod\google\maps\markers\GoogleMaps::widget([
                        'userLocations' => [
                            [
                                'location' => [
                                    'address' => 'Alpe+Santander',
                                    'country' => 'Spain',
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <br>
                <p>
                    ¡Ven a conocernos!
                </p>
                <p>
                    ¡Estaremos encantados de recibirte!
                </p>
            </div>
        </div>

<?php } ?>
</div>
