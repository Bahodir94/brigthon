<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;

class MailForm extends Model
{
    public $message;
    public $poster;

    public function rules()
    {
        return [
            [['message'], 'required'],
            ['poster', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'message' => 'Сообщение',
            'poster' => 'Картинка',
        ];
    }

    public function mail($image)
    {
        if($image) {
			$directory = Yii::getAlias('@app/web/img') . DIRECTORY_SEPARATOR;
			if (!is_dir($directory)) {
				FileHelper::createDirectory($directory);
            }
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $image->extension;
			$filePath = $directory . $fileName;
			if ($image->saveAs($filePath)) {
				$path = DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $fileName;
				$image = 'http://' . Yii::$app->getRequest()->serverName . $path;
			} else {
                $image = null;
            }
		}
        if ($this->validate()) {
            $telegram = new \Longman\TelegramBot\Telegram('1267510015:AAFKR-PPqQRqZsxbAwzQu3TvF5v3oY5FH00', 'pitauz_bot');
            $chats = Statistic::find()->all();
            foreach ($chats as $row) {
                if($image) {
                    $data = [
                        'chat_id' => $row->user_id,
                        'photo'   => $image,
                        'caption' => $this->message
                    ];
                    $result = \Longman\TelegramBot\Request::sendPhoto($data);
                } else {
                    \Longman\TelegramBot\Request::sendMessage(['chat_id' => $row->user_id, 'text' => $this->message]);
                }
                time_nanosleep(0, 500000);
            }
            return true;
        }
        return false;
    }
}
