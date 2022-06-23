<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Product;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Attributes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attributes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?
        echo $form->field($model, 'product_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Product::find()->all(), 'id', 'title_ru'),
            'options' => ['placeholder' => 'Выберите продукт...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?
        echo $form->field($model, 'type')->widget(Select2::classname(), [
            'data' => ["size" => "Размер", "depth" => "Толщина теста"],
            'options' => ['placeholder' => 'Выберите тип...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
