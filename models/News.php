<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $description_ru
 * @property string $description_uz
 * @property string $poster
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description_ru', 'description_uz', 'poster'], 'required'],
            [['description_ru', 'description_uz', 'poster'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description_ru' => 'Описание [RU]',
            'description_uz' => 'Описание [UZ]',
            'poster' => 'Картинка',
        ];
    }
}
