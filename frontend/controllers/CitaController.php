<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cita;
use frontend\models\search\CitaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;

/**
 * CitaController implements the CRUD actions for Cita model.
 */
class CitaController extends Controller
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


    public function actions(){
        return ArrayHelper::merge(parent::actions(), [
            'editcita'=>[
                'class'=>EditableColumnAction::className(),
                'modelClass'=>Cita::className(),
            ]
        ]);
    }

    /**
     * Lists all Cita models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CitaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->post('hasEditable')){
            $citaId = Yii::$app->request->post('editableKey');
            $cita = Cita::findOne($citaId);

            $out = Json::encode(['output'=>'', 'message'=>'']);
            $post = [];
            $posted = current($_POST('Cita'));
            $post['Cita'] = $posted;
            if($cita->load($post)){
                $cita->save();
                $output = 'my value';
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            echo $out;
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cita model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cita();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCita]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Cita model en el calendario.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCalendar($date)
    {
        $model = new Cita();
        $model->fecha = $date;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['calendario']);
        } else {
            return $this->renderAjax('calendar', [
                'model' => $model,
            ]);
        }

    }

    public function actionCalendario(){
        $events = Cita::find()->joinWith('paciente')->where(['paciente.idUsuario' => Yii::$app->user->identity->id])->all();

        $tasks = [];

        foreach ($events as $eve) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eve->idCita;
            $event->title = $eve->getPacienteNombre($eve->Paciente_idPaciente);
            $event->start = $eve->fecha.' '.$eve->hora;
            $event->end = $eve->fecha.' '.strtotime('+60 minute', strtotime($eve->hora));
            $tasks[] = $event; 
        }

        return $this->render('calendario', [
            'events'=>$tasks,]);
    }

    /**
     * Updates an existing Cita model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCita]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cita::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Obtiene todas las citas no pagas del paciente
    public function actionGetCita($id){
        $citas = Cita::find()->where(['Paciente_idPaciente'=>$id, 'cancelado' => 0])->asArray()->all();
        echo Json::encode($citas);
    }

    //cambia el valor de la cita
    public function actionCambiaCita($id){
        $model = $this->findModel($id);
        $model->cancelado = 1;

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

    static function actionCambiaCitaPaciente($id, $paciente){
        $model = Cita::findOne($id);
        $model->Paciente_idPaciente = $paciente;
        
        $model->save();
        
    }
}
