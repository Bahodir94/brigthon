<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title_ru',
            [
                "attribute" => "category_id",
                "value" => "category.full",
                "filter" => \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'full')
            ],
            'price',
            [
                "attribute" => "status",
                "label" => "Статус",
                "format" => "raw",
                "value" => function($m) {
                    if($m->status == 0) {
                        return '<span class="label label-danger">Отключен</span>';
                    } else {
                        return '<span class="label label-success">Включен</span>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
