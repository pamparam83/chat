<?php


namespace chat\services;


use chat\entities\Message;
use chat\entities\MessageAssignment;
use chat\forms\MessageForm;
use chat\repositories\MessageAssignmentRepository;
use chat\repositories\MessageRepository;
use yii\db\Query;

class MessageService
{
    private $_message;
    private $_assignment;

    public function __construct(MessageRepository $message, MessageAssignmentRepository $assignment)
    {
        $this->_message = $message;
        $this->_assignment = $assignment;
    }

    public function send(MessageForm $form,$idFriend)
    {
        $mess = Message::create(
            $form->text,
            \Yii::$app->user->id
        );
       $idMessage = $this->_message->save($mess);


       $this->_assignment->save($idMessage,$idFriend);
        return $mess;
    }

    public function getAllMessage($idFriend)
    {
        $messagesId = (new Query())->select(['message_id'])->from('{{%message_assignments}}')->where([
            'user_id' => \Yii::$app->user->id,
            'friend_id' => $idFriend
        ]);

//        var_dump($messagesId);exit;
        return (new Query())
            ->select(['*'])
            ->from('{{%messages}}')
            ->where(['id' => $messagesId])
            ->orderBy(['created_at' => SORT_ASC])
            ->all();

    }

}