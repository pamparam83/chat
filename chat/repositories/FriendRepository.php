<?php


namespace chat\repositories;
use chat\entities\User\Friend;

class FriendRepository
{

    /**
     * @param $idUser
     * @param $idFriend
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function isFriend($idUser,$idFriend)
    {
        if($friend = Friend::find()->where(['user_id' => $idUser,'friend_id' => $idFriend])->all()){
            return $friend;
        }
        return false;
    }

    public function getAllFriends($idUser)
    {
        if(!$friends = Friend::find()->select('friend_id')->where(['user_id' => $idUser])->asArray()->all()){
            return false;
        }
        return $friends;
    }

    public function addFriends($idUser, $idFriend)
    {
        // save user relation friend
        $friends = Friend::create($idUser, $idFriend);
        $friends->save();
        // save friend relation user
        $friends = Friend::create($idFriend, $idUser);
        $friends->save();
    }
}