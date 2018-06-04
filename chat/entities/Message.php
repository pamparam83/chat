<?php


namespace chat\entities;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Message
 * @package chat\entities
 * @property $text string
 * @property $create_at integer
 * @property $author integer
 */
class Message extends ActiveRecord
{

    public static function create($text,$author)
    {
        $message = new static();
        $message->text = $text;
        $message->author = $author;

        return $message;
    }
    public static function tableName()
    {
        return '{{%messages}}';
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Text',
            'status' => 'Status',
            'created_at' => 'Created_at',
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],

        ];
    }
}