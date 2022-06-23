<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property string $poster
 * @property string $message
 * @property int $subcategory_id
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_uz', 'sort'], 'required'],
            [['category_id', 'sort'], 'integer'],
            [['category_id'], 'default', 'value' => 0],
            [['title_ru','title_uz'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Категория [RU]',
            'title_uz' => 'Категория [UZ]',
            'category_id' => 'Субкатегория',
            'sort' => 'Сортировка',
        ];
    }
	
	public function getSubcategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getFull()
    {
        $title = '';
        $m = $this->getSubcategory()->one();
        while($m) {

            $title = $title . ' -> ' . $m->title_ru;
            $m = $m->getSubcategory()->one();
        }
        return trim($title . ' -> ' . $this->title_ru, ' -> ');
    }
}
