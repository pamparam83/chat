<?php
namespace chat\services\auth;

use chat\repositories\UserRepository;
use chat\forms\auth\PasswordResetRequestForm;
use chat\entities\User\User;
use chat\forms\auth\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{

    public $supportEmail;
    /**
     * @var MailerInterface
     */
    public $mailer;

    public $users;
    /**
     * PasswordResetService constructor.
     * @param $supportEmail
     */

    public function __construct($supportEmail,UserRepository $users, MailerInterface $mailer)
    {
        $this->supportEmail = $supportEmail;
        $this->mailer = $mailer;
        $this->users = $users;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function request(PasswordResetRequestForm $form)
    {
        /* @var $user User */
       $user = $this->users->getByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException('User is not fount');
        }

        $user->requestPasswordReset();
        $this->users->save($user);

        $send = $this->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $user]
            )
            ->setFrom($this->supportEmail)
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if(!$send){
            throw  new \RuntimeException('Send: sanding error.');
        }
    }

    /**
     *  Validating Token
     * @param $token
     */
    public function validateToken($token)
    {
        if(empty($token) || !is_string($token)){
            throw new \DomainException('Password reset token cannot be blank.');
        }

        if (!$this->users->existsByPasswordResetToken($token)){
            throw new \DomainException('Wrong password reset token.');
        }
    }

   public function reset($token, ResetPasswordForm $form)
   {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);

   }
}