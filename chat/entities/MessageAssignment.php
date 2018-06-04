<?php
namespace chat\entities;

use yii\db\ActiveRecord;

/**
 * @property integer $user_id;
 * @property integer $friend_id;
 * @property integer $message_id;
 * @property integer $status;
 */
class MessageAssignment extends ActiveRecord
{
    const STATUS_READ = 1;
    const STATUS_UNREAD = 0;
    public static function create($messageId,$idUser,$idFriend,$status)
    {
        $assignment = new static();
        $assignment->message_id = $messageId;
        $assignment->user_id = $idUser;
        $assignment->friend_id = $idFriend;
        $assignment->status = $status;
        return $assignment;
    }

    public static function tableName()
    {
        return '{{%message_assignments}}';
    }


}