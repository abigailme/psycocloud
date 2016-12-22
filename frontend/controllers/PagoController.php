<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pago;
use frontend\models\search\PagoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagoController implements the CRUD actions for Pago model.
 */
class PagoController extends Controller
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
     * Lists all Pago models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pago model.
     * @param integer $idFactura
     * @param integer $Paciente_idPaciente
     * @return mixed
     */
    public function actionView($idFactura, $Paciente_idPaciente)
    {
        return $this->render('view', [
            'model' => $this->findModel($idFactura, $Paciente_idPaciente),
        ]);
    }

    /**
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pago();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idFactura' => $model->idFactura, 'Paciente_idPaciente' => $model->Paciente_idPaciente]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idFactura
     * @param integer $Paciente_idPaciente
     * @return mixed
     */
    public function actionUpdate($idFactura, $Paciente_idPaciente)
    {
        $model = $this->findModel($idFactura, $Paciente_idPaciente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idFactura' => $model->idFactura, 'Paciente_idPaciente' => $model->Paciente_idPaciente]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pago model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idFactura
     * @param integer $Paciente_idPaciente
     * @return mixed
     */
    public function actionDelete($idFactura, $Paciente_idPaciente)
    {
        $this->findModel($idFactura, $Paciente_idPaciente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idFactura
     * @param integer $Paciente_idPaciente
     * @return Pago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idFactura, $Paciente_idPaciente)
    {
        if (($model = Pago::findOne(['idFactura' => $idFactura, 'Paciente_idPaciente' => $Paciente_idPaciente])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
