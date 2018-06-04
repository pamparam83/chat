<?php
namespace common\bootstrap;

use chat\services\auth\SignupService;
use chat\services\ContactService;
use yii\base\BootstrapInterface;
use chat\services\auth\PasswordResetService;
use yii\rbac\ManagerInterface;
use yii\mail\MailerInterface;
use yii\caching\Cache;

class SetUp implements  BootstrapInterface
{
   public function bootstrap($app)
   {
       $container = \Yii::$container;

       $container->setSingleton(PasswordResetService::class,[],[
           [$app->params['supportEmail'] => $app->name . ' robot'],
       ]);

       $container->setSingleton(SignupService::class,[],[
           [$app->params['supportEmail'] => $app->name . ' robot'],
       ]);


       $container->setSingleton(Cache::class, function () use ($app) {
           return $app->cache;
       });

       $container->setSingleton(ManagerInterface::class, function () use ($app) {
           return $app->authManager;
       });

       $container->setSingleton(MailerInterface::class, function() use ($app){
           return $app->mailer;
       } );
       $container->setSingleton(ContactService::class,[],[
          [$app->params['supportEmail'] => $app->name . ' robot'],
           $app->params['adminEmail'] ,
       ]);

   }
}