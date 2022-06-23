<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attributes */

$this->title = 'Обновить аттрибут' . $model->title_ru;
$this->params['breadcrumbs'][] = ['label' => 'Аттрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title_ru, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="attributes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
