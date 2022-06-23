<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Category;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
$categories = Category::find()->all();
$categories = ArrayHelper::map($categories, 'id', 'full');
$categories[0] = "Главная категория";
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
	
	<?php
	
	echo $form->field($model, 'category_id')->widget(Select2::classname(), [
		'data' => $categories,
		'options' => ['placeholder' => 'Выберите субкатегорию...'],
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
