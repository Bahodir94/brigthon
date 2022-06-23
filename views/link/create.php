<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Links */

$this->title = 'Добавить метку';
$this->params['breadcrumbs'][] = ['label' => 'UTM-метки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
