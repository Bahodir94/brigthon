<?php

namespace app\controllers;

use app\models\Post;
use app\models\PostSearch;
use app\models\Statistic;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();
        $imageFile = UploadedFile::getInstance($model, 'media');
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $img = $model->upload($imageFile);
                if ( $img != null){
                    $model->media = $img;
                }
                $chats = Statistic::getAll();
                $txt = implode(",", $chats);
                $model->users_id = $txt;
                $post = Post::findOne(['status' => 'отправка']);
                if ($post) $model->status = 'в ожидании';
                $model->save();
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSend()
    {
        $time = time();
        $post = Post::findOne(['status'=>'отправка']);
        if ($post){
            $users = explode(",", $post->users_id);
            if ($users){
                $sent = [];
                // for ($i=1; $i<=1000; $i++){
                //     array_push($users, "283631065");
                // }
                $users_id = $users;
                // echo implode(",", $users_id);
                // exit;
                foreach($users as $k => $user){
                    // $telegram = new \Longman\TelegramBot\Telegram('1267510015:AAFKR-PPqQRqZsxbAwzQu3TvF5v3oY5FH00', 'pitauz_bot');
                    $telegram = new \Longman\TelegramBot\Telegram('309698747:AAGPvaRGYHH2WNlw7XkvLO1LIPQrkzPFZ48', 'Teloffbot');
                    $tim = time();
                    if (Statistic::getLang($user)  == 'uz') $text = $post->content_uz;
                    else $text = $post->content_ru;
                        if($post->media != '') {
                            $data = [
                                'chat_id' => $user,
                                'photo'   => $image,
                                'caption' => $text
                            ];
                            $result = \Longman\TelegramBot\Request::sendPhoto($data);
                            time_nanosleep(0, 800000);
                        } else {
                            $diff =$tim-$time;
                            $result = \Longman\TelegramBot\Request::sendMessage(['chat_id' => $user, 'text' => "$text : $k sec: $diff"]);
                            time_nanosleep(0, 800000);
                        }
                        if (($key = array_search($user, $users_id)) !== false) {
                            unset($users_id[$key]);
                        }
                        if ($result->ok == true) {
                            array_push($sent, $user);
                        }
                    if ($k==160) break;
                }
                if ($post->send_start == null) $post->send_start = $time;
                $post->sent = implode(',',$sent);
                $post->users_id = implode(',',$users_id);
                if (count($users_id) == 0){
                    $post->status = 'отправлено';
                    $post->send_end = $tim;
                    $new_post = Post::findOne(['status'=>'в ожидании']);
                    if ($new_post) {
                        $new_post->status = "отправка";
                        $new_post->save();
                    }
                }
                $post->save(); 
                return $this->asJSON(['status'=>'ok', 'message' => count($sent)]);
            }
            // $post->sent
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
