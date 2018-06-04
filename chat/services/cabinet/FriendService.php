<?php
namespace chat\services\cabinet;

use chat\repositories\FriendRepository;
use chat\repositories\UserRepository;
use yii\helpers\ArrayHelper;
use chat\entities\User\Friend;
class FriendService
{

    private $_users;
    private $_friends;


    public function __construct(UserRepository $users, FriendRepository $friends)
    {
        $this->_users = $users;
        $this->_friends = $friends;
    }
   
    public function attach($idUser, $idFriend)
    {       
        if(!$user = $this->_users->get($idFriend)){
            throw new \RuntimeException('Error: is not exists user.');
        }

        $this->_friends->addFriends($idUser, $idFriend);

    }

    /**
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function isFriend($idUser,$idFriend)
    {
        return $this->_friends->isFriend($idUser,$idFriend);
    }

    public function getAllFriends($idUser)
    {
        $friends = false;
        if($idFriends = $this->_friends->getAllFriends($idUser)){
            $friends = $this->_users->getFriends(ArrayHelper::getColumn($idFriends,'friend_id'));
        }
        return $friends;
    }
}
