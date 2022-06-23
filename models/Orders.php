<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $location
 * @property string $phone
 * @property string $pay
 * @property string $promocode
 * @property string $name
 * @property string $delivery
 * @property int $balls
 * @property string $body
 * @property string $sum
 * @property string $sumWithPromo
 * @property string $comment
 * @property int $status
 * @property string $lang
 * @property string $createdAt
 * @property string $updatedAt
 */
class Orders extends \yii\db\ActiveRecord
{
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
            [['user_id', 'location', 'phone', 'pay', 'promocode', 'name', 'balls', 'body', 'sum', 'sumWithPromo', 'comment', 'status', 'lang', 'createdAt', 'updatedAt'], 'required'],
            [['user_id', 'balls', 'status'], 'integer'],
            [['location', 'body', 'comment'], 'string'],
            [['sum', 'sumWithPromo'], 'number'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['phone', 'pay', 'promocode', 'name'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Telegram ID',
            'location' => 'Локация',
            'phone' => 'Телефон',
            'pay' => 'Тип оплаты',
            'promocode' => 'Промокод',
            'name' => 'Имя',
            'balls' => 'Баллы',
            'body' => 'Корзина',
            'sum' => 'Сумма',
            'sumWithPromo' => 'Окончательная сумма',
            'comment' => 'Комментарий',
            'status' => 'Статус',
            'lang' => 'Язык',
            'createdAt' => 'Создан',
            'updatedAt' => 'Обновлен',
        ];
    }
    
    public function label() {
        $status = "неизвестно";
        if ($this->status == -1) {
            $status = '<span class="label label-danger">отказ</span>';
        } else if ($this->status == 0) {
            $status = '<span class="label label-warning">не обработан</span>';
        } else if ($this->status == 1) {
            $status = '<span class="label label-info">принят</span>';
        } else if ($this->status == 2) {
            $status = '<span class="label label-default">в доставке</span>';
        } else if ($this->status == 3) {
            $status = '<span class="label label-success">доставлен</span>';
        } else if ($this->status == 4) {
            $status = '<span class="label label-primary">оплачен</span>';
        } else if ($this->status == 5) {
            $status = '<span class="label label-default">в процессе</span>';
        }
        return $status;
    }
}
