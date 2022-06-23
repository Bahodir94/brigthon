<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Orders;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Топовые товары';
$orders = Orders::find()->all();
$bodies = ArrayHelper::toArray($orders, [
  'app\models\Orders' => [
      'body' => function ($post) {
          return json_decode($post->body);
      },
  ],
]);
$products = [];
foreach($bodies as $body) {
  foreach($body as $product) {
    foreach($product as $o) {
      $title = $o['text'];
      $name = trim(explode(" x ", $o['text'])[0]);
      $count = trim(explode(" = ", explode(" x ", $o['text'])[1])[0]);
      $products[$name][] = ["name" => $name, "count" => (int)$count];
    }
  }
}
$sum = [];
foreach($products as $product) {
  foreach($product as $value) {
    $sum[$value['name']] += $value['count'];
  }
}
uasort($sum, function($a, $b) {
  return $a < $b;
});
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <table class="table table-striped">
    <thead>
      <tr>
        <th>Название позиции</th>
        <th>Количество заказов</th>
      </tr>
    </thead>
    <tbody>
      <? foreach($sum as $name => $count):?>
      <tr>
        <td><?= $name ?></td>
        <td><?= $count ?></td>
      </tr>
      <? endforeach;?>
    </tbody>
  </table>
</div>
