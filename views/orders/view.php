<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Заказ №" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить комменатрий', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <h1>Смена статусов</h1>
    <p>
    <?= Html::a('Отправлен', ['status', 'id' => $model->id, 'status' => 1], [
            'class' => 'btn btn-default',
            'data' => [
                'confirm' => 'Вы уверены что хотите сменить статус? Клиент будет уведомлен.',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Доставлен', ['status', 'id' => $model->id, 'status' => 2], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Вы уверены что хотите сменить статус? Клиент будет уведомлен.',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Отказ', ['status', 'id' => $model->id, 'status' => 3], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите сменить статус? Клиент будет уведомлен.',
                'method' => 'post',
            ],
        ]) ?>
        
        <?= Html::a('Доставлен (без оповещения)', ['status', 'id' => $model->id, 'status' => 4], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Вы уверены что хотите сменить статус? Клиент не будет уведомлен.',
                'method' => 'post',
            ],
        ]) ?>
</p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            [
                'label' => 'Локация',
                'format' => 'html',
                'value' => function($m) {
                    $location = json_decode($m->location);
                    if($location && $location->latitude)
					    return Html::a("https://maps.google.com/maps?q=$location->latitude,$location->longitude&ll=$location->latitude,$location->longitude&z=16", "https://maps.google.com/maps?q=$location->latitude,$location->longitude&ll=$location->latitude,$model->lon$location->longitude&z=16");
					else return $m->location;
                }
            ],
            'phone',
            'pay',
            'promocode',
            'name',
            'balls',
            [
                'label' => 'Корзина',
                'format' => 'html',
                'value' => function($m) {
                    $body = json_decode($m->body);
                    $cart = "";
                    foreach($body as $value) {
                        $cart .= $value->text . '<br>';
                    }
                    return $cart;
                }
            ],
            'sum',
            'sumWithPromo',
            'comment:ntext',
            [
                'label' => 'Статус',
                'format' => 'html',
                'value' => function($m) {
                    return $m->label();
                }
            ],
            'lang',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>
