<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "codes".
 *
 * @property int $id
 * @property string $code
 * @property string $startAt
 * @property string $endAt
 * @property string $sum
 * @property int $sale
 */
class Codes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'codes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'startAt', 'endAt'], 'required'],
            [['startAt', 'endAt'], 'safe'],
            [['sum'], 'number'],
            [['sale'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'startAt' => 'Дата начала',
            'endAt' => 'Дата окончания',
            'sum' => 'Сумма',
            'sale' => 'Процент',
        ];
    }
}
