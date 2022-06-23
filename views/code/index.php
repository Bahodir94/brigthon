<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Промокоды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить промокод', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'code',
            'startAt',
            'endAt',
            'sum',
            'sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
