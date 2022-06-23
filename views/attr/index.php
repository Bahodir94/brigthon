<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttributesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Атрибуты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить атрибут', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title_ru',
            'title_uz',
            'price',
            'product.title_ru',
           
            [
                "attribute" => "type",
                "label" => "Тип",
                "format" => "raw",
                "value" => function($m) {
                    if($m->type == "size") {
                        return '<span class="label label-danger">Размер</span>';
                    } else {
                        return '<span class="label label-success">Толщина теста</span>';
                    }
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
