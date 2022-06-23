<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statistic".
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $mobile
 * @property string $created_at
 * @property string $updated_at
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at'], 'required'],
            [['user_id'], 'integer'],
            [['language'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 24],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID юзера',
            'username' => 'Логин',
            'phone_number' => 'Телефон',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Последнее использование',
        ];
    }

    static public function getLang($user_id){
        $user = self::findOne(['user_id'=>$user_id]);
        return $user->language;
    }

    static public function getAll(){
        $users = self::find()->select(['user_id'])->asArray()->all();
        return array_column($users, 'user_id');
    }
}
