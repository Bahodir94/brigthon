<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attributes".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_uz
 * @property string $price
 * @property int $product_id
 */
class Attributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_uz', 'price', 'product_id', 'type'], 'required'],
            [['price'], 'number'],
            [['product_id'], 'integer'],
            [['title_ru', 'title_uz', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Название [RU]',
            'title_uz' => 'Название [UZ]',
            'price' => 'Цена',
            'product_id' => 'Продукт',
            'type' => 'Тип',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
