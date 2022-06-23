<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Filial */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Филиалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'body:ntext',
			[	
				'attribute' => 'location',
				'format' => 'raw',
				'value' => function($model) {
					return Html::a("https://maps.google.com/maps?q=$model->lat,$model->lon&ll=$model->lat,$model->lon&z=16", "https://maps.google.com/maps?q=$model->lat,$model->lon&ll=$model->lat,$model->lon&z=16");
				}
				
			]
        ],
    ]) ?>

</div>
