<?php

namespace app\models;
use yii\helpers\FileHelper;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $content_uz
 * @property string $content_ru
 * @property string|null $media
 * @property string $status
 * @property string $users_id
 * @property string|null $sent
 * @property string $created_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_uz', 'content_ru'], 'required'],
            [['content_uz', 'content_ru', 'users_id', 'sent'], 'string'],
            [['created_at', 'media', 'send_start', 'send_end'], 'safe'],
            [['status'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_uz' => 'Сообщение(Узб.)',
            'content_ru' => 'Сообщение(Рус.)',
            'media' => 'Файл',
            'status' => 'Статус',
            'users_id' => 'Users ID',
            'sent' => 'Отправлено',
            'created_at' => 'Создан',
        ];
    }

    public function sentCount(){
        if (strlen($this->sent) == 0)
        return 0;
        $count = explode(',', trim($this->sent));
        return count($count);
    }

    public function upload($image)
    {
        if($image) {
			$directory = Yii::getAlias('@app/web/post') . DIRECTORY_SEPARATOR;
			if (!is_dir($directory)) {
				FileHelper::createDirectory($directory);
            }
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $image->extension;
			$filePath = $directory . $fileName;
			if ($image->saveAs($filePath)) {
				$path = '/post/'. $fileName;
				$image = Yii::$app->request->hostInfo . $path;
                return $image;
			} else {
                $image = null;
            }
            return $image;
		}
        // if ($this->validate()) {
        //     $telegram = new \Longman\TelegramBot\Telegram('1267510015:AAFKR-PPqQRqZsxbAwzQu3TvF5v3oY5FH00', 'pitauz_bot');
        //     $chats = Statistic::find()->all();
        //     foreach ($chats as $row) {
        //         if($image) {
        //             $data = [
        //                 'chat_id' => $row->user_id,
        //                 'photo'   => $image,
        //                 'caption' => $this->message
        //             ];
        //             $result = \Longman\TelegramBot\Request::sendPhoto($data);
        //         } else {
        //             \Longman\TelegramBot\Request::sendMessage(['chat_id' => $row->user_id, 'text' => $this->message]);
        //         }
        //         time_nanosleep(0, 500000);
        //     }
        //     return true;
        // }
        return false;
    }
}
