<?php

namespace app\controllers;

use Yii;
use app\models\Tareas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TareasController implements the CRUD actions for Tareas model.
 */
class TareasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Tareas models.
     * @return mixed
     */
    public function actionIndex($username)
    {
        
        $dataProvider = new ActiveDataProvider([
            'query' => Tareas::find()->where(['propietario'=>$username]),
        ]);
        
        
                
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionListar()
    {
        
        $dataProvider = new ActiveDataProvider([
            'query' => Tareas::find(),
        ]);
                
        return $this->render('listar', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Tareas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tareas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tareas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'username' => $model->propietario]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tareas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'username' => $model->propietario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tareas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        $this->findModel($id)->delete();
        
        return $this->redirect(['index', 'username'=>Yii::$app->user->identity->username]);
    }

    /**
     * Finds the Tareas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tareas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tareas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
