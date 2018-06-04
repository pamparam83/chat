<?php


namespace chat\repositories;


use chat\entities\Message;

class MessageRepository
{



    public function save(Message $message)
    {
        if (!$message->save()) {
            throw new \RuntimeException('Saving error.');
        }

        return $message->id;
    }
}