<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
			'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStatus($id, $status)
    {
        $telegram = new \Longman\TelegramBot\Telegram('1220232605:AAGecOSfOE-VQxN2_F_pJlGTdl23uLIcUX8', 'pitauz_bot');
        $model = $this->findModel($id);
        if($status == 1) {
            $model->status = 2;
            if($model->lang == 'ru')
                \Longman\TelegramBot\Request::sendMessage(['chat_id' => $model->user_id, 'text' => "Ваш заказ уже в пути, наш курьер скоро свяжется с Вами 🚗"]);
            if($model->lang == 'uz')
                \Longman\TelegramBot\Request::sendMessage(['chat_id' => $model->user_id, 'text' => "Ваш заказ уже в пути, наш курьер скоро свяжется с Вами 🚗"]);
        } else if($status == 2) {
            $model->status = 3;
            if($model->lang == 'ru')
                \Longman\TelegramBot\Request::sendMessage(['chat_id' => $model->user_id, 'text' => "Ваш заказ доставлен. Спасибо, что выбираете нас!"]);
            if($model->lang == 'uz')
                \Longman\TelegramBot\Request::sendMessage(['chat_id' => $model->user_id, 'text' => "Ваш заказ доставлен. Спасибо, что выбираете нас!"]);
        } else if($status == 3) {
            $model->status = -1;
            if($model->lang == 'ru')
                \Longman\TelegramBot\Request::sendMessage(['chat_id' => $model->user_id, 'text' => "Ваш заказ №$model->id отменен 😕"]);
            if($model->lang == 'uz')
                \Longman\TelegramBot\Request::sendMessage(['chat_id' => $model->user_id, 'text' => "Ваш заказ №$model->id отменен 😕"]);
        }
        else if($status == 4) {
            $model->status = 3;
        }
        $model->save();
        

        Yii::$app->session->setFlash('success', 'Все прошло удачно');
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    
    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
