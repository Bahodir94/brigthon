<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = "#".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status',
            'delivery',
            'address',
            [
				'attribute' => 'location',
				'format' => 'raw',
				'value' => function($model) {
					if($model->lat && $model->lon)
						return Html::a("https://maps.google.com/maps?q=$model->lat,$model->lon&ll=$model->lat,$model->lon&z=16", "https://maps.google.com/maps?q=$model->lat,$model->lon&ll=$model->lat,$model->lon&z=16");
					else return "Не задано";
				}
			],
            'number',
            'pay',
            [
				"label" => "Корзина",
				"format" => "raw",
				"value" => function($model) {
					$html = [];
					foreach($model->parsedCart as $product) {
						$html[] = $product['title'] . " - " . $product['count'] . " шт.";
					}
					return implode("<br>", $html);
				}
			],
            'price',
            'operator_id',
			[
				"label" => 'Филиал',
				"value" => $model->filial0->title
			],
            'statusChangedAt:datetime',
        ],
    ]) ?>

</div>
