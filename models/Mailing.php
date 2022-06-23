<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mailing".
 *
 * @property int $id
 * @property string $message
 * @property string $poster
 * @property int $offset
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Mailing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'offset', 'status'], 'required'],
            [['message', 'poster'], 'string'],
            [['offset', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'poster' => 'Poster',
            'offset' => 'Offset',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
