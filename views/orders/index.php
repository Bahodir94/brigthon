<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Orders;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
		
		<div class="col-md-3">
			<div class="dbox dbox--color-2">
				<div class="dbox__icon">
					<i class="glyphicon glyphicon-eye-open"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?= Orders::find()->where(['status' => 0])->count() ?></span>
					<span class="dbox__title">НЕОБРАБОТАННЫЕ</span>
				</div>
				
				<div class="dbox__action">
                <a href="/orders?OrdersSearch%5Bid%5D=&OrdersSearch%5Bname%5D=&OrdersSearch%5Bphone%5D=&OrdersSearch%5Bpay%5D=&OrdersSearch%5Bstatus%5D=0&OrdersSearch%5BsumWithPromo%5D=&OrdersSearch%5BcreatedAt%5D=" class="dbox__action__btn">показать</a>
				</div>				
			</div>
        </div>
        <div class="col-md-3">
			<div class="dbox dbox--color-3">
				<div class="dbox__icon">
					<i class="glyphicon glyphicon-credit-card"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?= Orders::find()->where(['status' => 1])->count() ?></span>
					<span class="dbox__title">НЕЗАКОНЧЕННЫЕ</span>
				</div>
				
				<div class="dbox__action">
                <a href="/orders?OrdersSearch%5Bid%5D=&OrdersSearch%5Bname%5D=&OrdersSearch%5Bphone%5D=&OrdersSearch%5Bpay%5D=&OrdersSearch%5Bstatus%5D=1&OrdersSearch%5BsumWithPromo%5D=&OrdersSearch%5BcreatedAt%5D=" class="dbox__action__btn">показать</a>
				</div>				
			</div>
        </div>
        <div class="col-md-3">
			<div class="dbox dbox--color-5">
				<div class="dbox__icon">
					<i class="glyphicon glyphicon-map-marker"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?= Orders::find()->where(['status' => 2])->count() ?></span>
					<span class="dbox__title">В ДОСТАВКЕ</span>
				</div>
				
				<div class="dbox__action">
                <a href="/orders?OrdersSearch%5Bid%5D=&OrdersSearch%5Bname%5D=&OrdersSearch%5Bphone%5D=&OrdersSearch%5Bpay%5D=&OrdersSearch%5Bstatus%5D=2&OrdersSearch%5BsumWithPromo%5D=&OrdersSearch%5BcreatedAt%5D=" class="dbox__action__btn">показать</a>
				</div>				
			</div>
		</div>
        <div class="col-md-3">
			<div class="dbox dbox--color-4">
				<div class="dbox__icon">
					<i class="glyphicon glyphicon-ok"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count"><?= Orders::find()->where(['status' => 3])->count() ?></span>
					<span class="dbox__title">ВЫПОЛНЕНО</span>
				</div>
				
				<div class="dbox__action">
                <a href="/orders?OrdersSearch%5Bid%5D=&OrdersSearch%5Bname%5D=&OrdersSearch%5Bphone%5D=&OrdersSearch%5Bpay%5D=&OrdersSearch%5Bstatus%5D=3&OrdersSearch%5BsumWithPromo%5D=&OrdersSearch%5BcreatedAt%5D=" class="dbox__action__btn">показать</a>
				</div>				
			</div>
		</div>
		
	</div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'phone',
            'pay',
            [
                'attribute' => 'status',
                'format' => 'html',
                'filter' => [
                    -1 => "Отказ",
                    0 => "не обработан",
                    1 => "принят",
                    2 => "в доставке",
                    3 => "доставлен",
                    4 => "оплачен",
                    5 => "в процессе",
                ],
                'contentOptions'=>['class'=>'text-center'],
                'value' => function($m) {
                    return $m->label();
                },
            ],
            'sumWithPromo',
            //'promocode',
            //'delivery',
            //'balls',
            //'body:ntext',
            //'sum',
            //'sumWithPromo',
            //'comment:ntext',
            //'lang',
            'createdAt:datetime',
            //'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
