<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "filials".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $location
 */
class Filial extends \yii\db\ActiveRecord
{
	public $lat;
	public $lon;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body', 'location', 'lat', 'lon'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'body' => 'Сообщение',
            'location' => 'Локация',
            'lat' => 'Широта',
            'lon' => 'Долгота',
        ];
    }
	
	public function afterFind() {
		$location = json_decode($this->location);
		$this->lat = $location->lat;
		$this->lon = $location->lon;
	}
	
	public function beforeSave($insert) {
		$this->location = json_encode([
			"lat" => $this->lat,
			"lon" => $this->lon,
		]);
		return true;
	}
}
