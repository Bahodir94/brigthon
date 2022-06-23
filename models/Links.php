<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property int $count
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['count'], 'integer'],
            [['count'], 'default', 'value' => 0],
            [['title'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название источника',
            'code' => 'Код для бота',
            'count' => 'Количество использований',
        ];
    }
}
