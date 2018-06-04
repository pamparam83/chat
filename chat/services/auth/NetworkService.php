<?php
namespace chat\services\auth;
use chat\entities\User\User;
use chat\repositories\UserRepository;
class NetworkService
{
    private $users;
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    public function auth($network, $identity)
    {
        if ($user = $this->users->findByNetworkIdentity($network, $identity)) {
            return $user;
        }
        $user = User::signupByNetwork($network, $identity);
        $this->users->save($user);
        return $user;
    }
    public function attach($id, $network, $identity)
    {
        // проверяем нет ли такого же пользователя с такими же параметрами
        if ($this->users->findByNetworkIdentity($network, $identity)) {
            throw new \DomainException('Network is already signed up.');
        }
        $user = $this->users->get($id);
        $user->attachNetwork($network, $identity);
        $this->users->save($user);
    }
}