<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Links */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'UTM-метки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'code',
            'count',
            [
                'label' => 'Ссылка для использования',
                'value' => function($model) {
                    return "https://t.me/baxtuzbot?start=" . $model->code;
                }
            ]
        ],
    ]) ?>

</div>
