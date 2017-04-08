<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Paciente;
use frontend\models\search\PacienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\controllers\CitaController;

/**
 * PacienteController implements the CRUD actions for Paciente model.
 */
class PacienteController extends Controller
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
     * Lists all Paciente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PacienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paciente model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Paciente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paciente();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPaciente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    

    //Obtiene la tarifa del paciente
    public function actionGetTarifa($id){
        $tarifa = Paciente::findOne($id);
        echo Json::encode($tarifa);
    }

    /**
     * Updates an existing Paciente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        
        $paciente = new Paciente();



        if ($paciente->load(Yii::$app->request->post()) && $paciente->save()) {
            $paciente->getCitasPaciente($id, $paciente->idPaciente);
            $this->actionDelete($id);
            return $this->redirect(['view', 'id' => $paciente->idPaciente]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Paciente model.
     * If deletion is successful, the brow;ser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

/*    public function beforeUpdate($id){
        $model = $this->findModel($id);


        $paciente['nombre'] = \Yii::$app->encrypter->decrypt($model->p_nombre);
        $paciente['s_nombre'] = \Yii::$app->encrypter->decrypt($model->s_nombre);
        $paciente['apellido'] = \Yii::$app->encrypter->decrypt($model->p_apellido);
        $paciente['s_apellido'] = \Yii::$app->encrypter->decrypt($model->s_apellido);
        $paciente['cedula'] = \Yii::$app->encrypter->decrypt($model->cedula);
        $paciente['email'] = \Yii::$app->encrypter->decrypt($model->email);
        $paciente['motivo_consulta'] = \Yii::$app->encrypter->decrypt($model->motivo_consulta);
        $paciente['antecedentes'] = \Yii::$app->encrypter->decrypt($model->antecedentes);
        $paciente['celular'] = \Yii::$app->encrypter->decrypt($model->celular);
        $paciente['local'] = \Yii::$app->encrypter->decrypt($model->local);
        $paciente['seudonimo'] = \Yii::$app->encrypter->decrypt($model->seudonimo);
        $paciente['edad'] = \Yii::$app->encrypter->decrypt($model->edad);
        $paciente['fecha_nacimiento'] 

        $model->save();

    }

    
    /**
     * Finds the Paciente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paciente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paciente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Obtener edad
    public function actionGetEdad($fecha){
        $edad = Paciente::calcularEdad($fecha);
        echo Json::encode($edad);
    }

    //Cambia la deuda del paciente
    public function actionCambiarDeuda($id){
        $model = $this->findModel($id);
        $model->deuda = 1000;
        $model->save();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        echo Json::encode($model);
    }



}
