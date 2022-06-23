<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $status
 * @property string $delivery
 * @property string $address
 * @property string $location
 * @property string $number
 * @property string $pay
 * @property string $cart
 * @property string $price
 * @property int $operator_id
 * @property int $filial
 * @property int $statusChangedAt
 */
class Order extends \yii\db\ActiveRecord
{
	public $parsedCart = [];
	public $lat;
	public $lon;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'operator_id', 'filial', 'statusChangedAt'], 'integer'],
            [['cart'], 'string'],
            [['price'], 'number'],
            [['statusChangedAt'], 'required'],
            [['delivery', 'address', 'location', 'number', 'pay'], 'string', 'max' => 255],
        ];
    }

	public function afterFind() {
		$cart = json_decode($this->cart);
		foreach($cart as $product) {
			$pr = Product::findOne($product->id);
			$this->parsedCart[] = ["id" => $pr->id, "title" => $pr->title, "count" => $product->count];
		}
		if(empty($this->location)) {
			$location = json_decode($this->location);
			$this->lat = $location->lat;
			$this->lon = $location->lon;
		}
	}
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'delivery' => 'Тип доставки',
            'address' => 'Адрес',
            'location' => 'Локация',
            'number' => 'Номер телефона',
            'pay' => 'Тип платежа',
            'cart' => 'Корзина',
            'price' => 'Цена',
            'operator_id' => 'Оператор',
            'filial' => 'Филиал',
            'statusChangedAt' => 'Последнее изменение',
        ];
    }
	
	public function getFilial0()
    {
        return $this->hasOne(Filial::className(), ['id' => 'filial']);
    }
}
