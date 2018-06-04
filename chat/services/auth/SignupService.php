<?php

namespace chat\services\auth;

use chat\entities\User\User;
use chat\forms\auth\SignupForm;
use chat\repositories\UserRepository;
use chat\services\TransactionManager;
use Yii;
use yii\mail\MailerInterface;

class SignupService
{
    private $users;
    private $transaction;
    private $mailer;
    public $supportEmail;

    public function __construct(
        $supportEmail,
        UserRepository $users,
        TransactionManager $transaction,
        MailerInterface $mailer
    )
    {
        $this->users = $users;
        $this->supportEmail = $supportEmail;
        $this->transaction = $transaction;
        $this->mailer = $mailer;
    }

    /**
     * @param SignupForm $form
     * @throws \Exception
     */
    public function signup(SignupForm $form)
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
        });
        $send = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            ->setFrom($this->supportEmail)
            ->setTo($user->email)
            ->setSubject('Подтверждение Email на ' . Yii::$app->name)
            ->send();

        if(!$send){
            throw  new \RuntimeException('Ошибка: письмо не отправлено.');
        }
    }

    public function confirm($token)
    {
        if (empty($token)) {
            throw new \DomainException('Такого токена не существует.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}