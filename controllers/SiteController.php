<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\widgets\ActiveForm;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        // en caso de no estar logueado nos colocamos en la pagina de inicio
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        // en caso de intentar realizar un logueo

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // si es correcto volvemos a la pagina anterior
            return $this->goBack();
        }

        // en caso de que el logueo no sea correcto no entramos
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        // nos salimos de la sesion
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistrar() {
        $model = new User();
        $model->scenario="crear";
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        /* crear el usuario */
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('mensaje',["model"=>$model]);
        }

        return $this->render('registro', [
                    'model' => $model,
        ]);
    }

    public function actionConfirm() {
        if (Yii::$app->request->get()) {

            //Obtenemos el valor de los parámetros get
            $id = \yii\helpers\Html::decode($_GET["id"]);
            $authKey = \yii\helpers\Html::decode($_GET["authKey"]);

            if ((int) $id) {
                //Realizamos la consulta para obtener el registro
                $model = User::find()
                        ->where("id=:id", [":id" => $id])
                        ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
                
                //Si el registro existe
                if ($model->count() == 1) {
                    $activar = User::findOne($id);
                    $activar->activo = 1;
                    $activar->scenario="actualizar";
                    
                    if ($activar->save()) {
                        echo "Enhorabuena registro llevado a cabo correctamente, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='5; " . \yii\helpers\Url::to(["site/login"]) . "'>";
                    } else {
                        echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='5; " . \yii\helpers\Url::to(["site/login"]) . "'>";
                    }
                } else { //Si no existe redireccionamos a login
                    return $this->redirect(["site/login"]);
                }
            } else { //Si id no es un número entero redireccionamos a login
                return $this->redirect(["site/login"]);
            }
        }
    }
    
        public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('Correo');
            //evitar envio masivo del correo con F5
            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

}
