<?php


namespace chat\repositories;


use chat\entities\MessageAssignment;
use yii\db\Query;

class MessageAssignmentRepository
{
    public function getCountSend($id)
    {
        $idMessage = (new Query())->select('message_id')->from('{{%message_assignments}}')->where(['user_id' => $id]);
        return (new Query())
            ->from('{{%messages}}')
            ->where(['author' => $id])
            ->andWhere(['id' => $idMessage])
            ->count();
    }
    public function getCountInbox($id)
    {
        $idMessage = (new Query())->select('message_id')->from('{{%message_assignments}}')->where(['user_id' => $id]);
        return (new Query())
            ->from('{{%messages}}')
            ->where(['<>','author', $id])
            ->andWhere(['id' => $idMessage])
            ->count();
    }

    public function getCountUnread($id)
    {
        return MessageAssignment::find()
            ->where(['user_id' => $id])
            ->andWhere(['status' => 0])
            ->count();
    }
    public function save($idMessage,$idFriend)
    {
        $user = MessageAssignment::create(
            $idMessage,
            \Yii::$app->user->id,
            $idFriend,
            MessageAssignment::STATUS_READ
        );
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        $friend = MessageAssignment::create(
            $idMessage,
            $idFriend,
            \Yii::$app->user->id,
            MessageAssignment::STATUS_UNREAD
        );
        if (!$friend->save()) {
            throw new \RuntimeException('Saving error.');
        }
//        return $message->id;
    }
}