<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $body
 * @property string $price
 * @property string $poster
 *
 * @property Categories $category
 */
class Product extends \yii\db\ActiveRecord
{
	public $poster_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title_ru', 'title_uz', 'price', 'status', 'sort'], 'required'],
            [['category_id', 'status', 'sort'], 'integer'],
            [['desc_ru', 'desc_uz', 'poster'], 'string'],
            [['price'], 'number'],
            [['poster_file'], 'safe'],
            [['title_ru', 'title_uz'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

	public function uploadNSave($image)
	{
		if($image) {
			$directory = Yii::getAlias('@app/web/img') . DIRECTORY_SEPARATOR;
			if (!is_dir($directory)) {
				FileHelper::createDirectory($directory);
            }
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $image->extension;
			$filePath = $directory . $fileName;
			if ($image->saveAs($filePath)) {
				$path = DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $fileName;
				$this->poster = 'http://' . Yii::$app->getRequest()->serverName . $path;
			} else {
				$this->poster = '';
			}
		}
		return $this->save() ? true : false;
	}
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'status' => 'Видимость товара',
            'title_ru' => 'Название продукта [RU]',
            'title_uz' => 'Название продукта [UZ]',
            'desc_ru' => 'Описание [RU]',
            'desc_uz' => 'Описание [UZ]',
            'price' => 'Цена',
            'sort' => 'Сортировка',
            'poster' => 'Картинка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
