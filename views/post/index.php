<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать сообщение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'media',
                'format'    => 'raw',
                'value'     => function($model){
                    return "<img src='$model->media' height='200px'>";
                }
            ],
            'content_uz:ntext',
            'content_ru:ntext',
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'value'     => function($model){
                    $text = '';
                    switch ($model->status){
                        case "отправка": $text = "<span class='label label-warning'>отправка</span>"; break;
                        case "отправлено": $text = "<span class='label label-success'>отправлено</span>"; break;
                        case "отменен": $text = "<span class='label label-danger'>отменен</span>"; break;
                        case "в ожидании": $text = "<span class='label label-primary'>в ожидании</span>"; break;
                    }
                    return $text;
                }
            ],
            [
                'attribute' =>  'sent',
                'format'    => 'raw',
                'value' =>  function($model){
                    return "<span class='badge'>".$model->sentCount()."</span>";
                }
            ],
            [
                'attribute' => 'send_start',
                'label' => 'Начало/закончен',
                'format'    => 'raw',
                'value'     => function($model){
                    return "<span class='text-primary'>".Yii::$app->formatter->asDateTime($model->send_start)."</span>"."/<span class='text-success'>".\Yii::$app->formatter->asTime($model->send_end)."</span>"; 
                }
            ],
            'created_at:datetime',

            // [
            //     'class' => ActionColumn::className(),
            //     'template'  => "{delete}",
            //     'urlCreator' => function ($action, $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
