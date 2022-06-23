<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\base\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$orders = json_encode($orders);
$this->registerJs("ymaps.ready(function () {
  var json = $orders
  json = json.map(e => {
    var loc = false
    try {
      loc = JSON.parse(e.location)
    }catch(e){}
    if(loc) {
      return [loc.latitude, loc.longitude]
    }
    
  }).filter(e => e)
  var map = new ymaps.Map('map', {
      center: [39.650285, 66.966833],
      controls: [],
      zoom: 11
  });
  ymaps.modules.require(['Heatmap'], function (Heatmap) {
    console.log(json)
    var heatmap = new Heatmap(json, {
        // Радиус влияния.
        radius: 17,
        // Нужно ли уменьшать пиксельный размер точек при уменьшении зума. False - не нужно.
        dissipating: false,
        // Прозрачность тепловой карты.
        opacity: 0.7,
        // Прозрачность у медианной по весу точки.
        intensityOfMidpoint: 0.2,
        // JSON описание градиента.
        gradient: {
            0.1: 'rgba(128, 255, 0, 0.7)',
            0.2: 'rgba(255, 255, 0, 0.8)',
            0.7: 'rgba(234, 72, 58, 0.9)',
            1.0: 'rgba(162, 36, 25, 1)'
        }
    });
    heatmap.setMap(map);
  });
})", yii\web\View::POS_HEAD);
$this->title = 'Карта заказов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <div id="map" style="width: 100%; height: 500px"></div>
    
</div>
