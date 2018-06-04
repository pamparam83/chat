<?php
namespace chat\services;

use chat\forms\auth\ContactForm;
use yii\mail\MailerInterface;
class ContactService
{
    private $supportEmail;
    private $adminEmail;
    private $mailer;

    public function __construct($supportEmail,$adminEmail, MailerInterface $mailer)
    {
        $this->supportEmail = $supportEmail;
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param ContactForm $form
     */
    public function send(ContactForm $form)
    {

        $send = $this->mailer->compose()
            ->setTo($form->email)
            ->setFrom($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if(!$send){
            throw new \RuntimeException('Не удалось отправить сообщение.');
        }
    }
}