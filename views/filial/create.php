<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Filial */

$this->title = 'Создать филиал';
$this->params['breadcrumbs'][] = ['label' => 'Филиалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
