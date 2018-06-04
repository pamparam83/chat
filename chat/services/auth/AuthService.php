<?php

namespace chat\services\auth;

use chat\forms\LoginForm;
use chat\repositories\UserRepository;
class AuthService
{
    private $users;
    
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    
    public function auth(LoginForm $form)
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if(!$user || !$user->isActive() || !$user->validatePassword($form->password)){
            throw new \DomainException('Не верный логин или пароль.');
        }
        
        return $user;
    }
}