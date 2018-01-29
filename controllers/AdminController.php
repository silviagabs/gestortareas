<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Tareas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTareas() {

        $dataProvider = new ActiveDataProvider([
            'query' => Tareas::find(),
        ]);

        return $this->render('tareas', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUsuarios() {

        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('usuarios', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewtareas($id) {
        return $this->render('viewtareas', [
                    'model' => $this->findModelTareas($id),
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $model->scenario = 'actualizar';
        // var_dump($model->scenario);
        //exit;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['usuarios', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionUpdatetareas($id) {

        $model = $this->findModelTareas($id);
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tareas', 'id' => $model->id_tarea]);
        }

        return $this->render('updatetareas', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['usuarios']);
    }
    
     public function actionDeletetareas($id) {
        $this->findModelTareas($id)->delete();

        return $this->redirect(['tareas']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página que buscas no existe.');
    }

    protected function findModelTareas($id) {
        if (($model = Tareas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página que buscas no existe.');
    }

}
