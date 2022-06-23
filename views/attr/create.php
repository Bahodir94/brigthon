<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Attributes */

$this->title = 'Добавить аттрибут';
$this->params['breadcrumbs'][] = ['label' => 'Аттрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
