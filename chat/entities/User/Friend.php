<?php
namespace chat\entities\User;
use yii\db\ActiveRecord;

/**
 * Class Friend
 *
 * @package core\entities\User
 * @property integer $user_id
 * @property integer $friend_id
 */
class Friend extends ActiveRecord
{

    public static function create($user,$friend)
    {
        $item = new static();
        $item->friend_id = $friend;
        $item->user_id = $user;
        return $item;
    }


    public static function tableName()
    {
        return '{{%friends}}';
    }

    public function getUser()
    {
        return $this->hasMany(User::class, ['id' => 'user_id']);
    }
}