<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Codes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="codes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <div class="alert alert-warning">
    Дата должна быть в формате ГГГГ-ММ-ДД. (пример: 2019-07-25)
</div>

    <?= $form->field($model, 'startAt')->textInput() ?>

    <?= $form->field($model, 'endAt')->textInput() ?>
    <div class="alert alert-success">
    Значение для поля сумма: пример 15000. Даст скидку на 15000 сум.
</div>
    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>


<div class="alert alert-success">
    Значение для поля скидки: от 1 до 100 целые числа.
</div>
    <?= $form->field($model, 'sale')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
