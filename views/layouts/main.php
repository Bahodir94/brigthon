<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=d4779293-73df-43a4-8c6e-c5dbe5691caa&lang=ru_RU" type="text/javascript"></script>
    <script src="https://yastatic.net/s3/mapsapi-jslibs/heatmap/0.0.1/heatmap.min.js" type="text/javascript"></script>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $active = false;
    if(isset($this->context->actionParams['type'])) $active = $this->context->actionParams['type'] == 'main';
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            //['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Продукты', 'url' => ['/product/index']],
            ['label' => 'Настройки', 'url' => ['/settings/index']],
            ['label' => 'Атрибуты', 'url' => ['/attr/index']],
            ['label' => 'Заказы', 'url' => ['/orders/index']],
            ['label' => 'Карта заказов', 'url' => ['/site/map']],
            ['label' => 'Акции и новости', 'url' => ['/news/index']],
            ['label' => 'Категории', 'url' => ['/category/index'], 'active' => $active],
            ['label' => 'Статистика', 'url' => ['#'], 'items' => [
                ['label' => 'Пользователи', 'url' => '/site/statistic'],
                ['label' => 'Заказы', 'url' => '/site/orders'],
             ]
            ],
            ['label' => 'Рассылка', 'url' => ['#'], 'items' => [
                ['label' => 'Рассылка почта', 'url' => '/site/mail'],
                ['label' => 'Рассылка Telegram', 'url' => '/site/telegram'],
             ]
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; DragoSFire <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
