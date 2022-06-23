<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Category;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	<?php
	
	echo $form->field($model, 'category_id')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(Category::find()->all(), 'id', 'full'),
		'options' => ['placeholder' => 'Выберите категорию...'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	
	?>
	
    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'desc_uz')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([
    '0' => 'Отключен',
    '1' => 'Активен',
]);?>
<?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'poster')->textarea(['rows' => 6])->label("Ссылка на картинку")	?>
	<br>
	<strong>или</strong>
	<br><br>
	<?= $form->field($model, 'poster_file')->fileInput()->label("Загрузите картинку") ?>
	<br>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
