<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Statistic;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MailForm;
use app\models\Orders;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'mail', 'statistic', 'map', 'orders'],
                'rules' => [
                    [
                        'actions' => ['logout', 'mail', 'statistic', 'map', 'orders'],
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
    public function actions()
    {
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionMail()
    {
        $model = new MailForm();
        $imageFile = UploadedFile::getInstance($model, 'poster');
        if ($model->load(Yii::$app->request->post()) && $model->mail($imageFile)) {
            return $this->goBack();
        }
        return $this->render('mail', [
            'model' => $model,
        ]);
    }
	
	public function actionStatistic()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Statistic::find(),
            'pagination' => [
				'pageSize' => 100,
			],
        ]);

        return $this->render('statistic', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMap()
    {
        $orders = Orders::find()->asArray()->all();
        return $this->render('map', [
            'orders' => $orders,
        ]);
    }

    public function actionOrders()
    {
        return $this->render('orders');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
