<?php

namespace frontend\controllers\auth;

use chat\services\auth\NetworkService;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class NetworkController extends Controller
{
    private $service;

    public function __construct($id,$module,NetworkService $service,array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actions()
    {
        return [
            'auth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this,'onAuthSuccess'],
            ]
        ];
    }

    public function onAuthSuccess(ClientInterface $client)
    {
        $network = $client->getId();
        $attributes = $client->getUserAttributes();
        $identity = ArrayHelper::getValue($attributes, 'id');

        try {
            $user = $this->service->auth($network,$identity);
            \Yii::$app->user->login($user, \Yii::$app->params['user.rememberMeDuration']);
        }catch (\DomainException $e){
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

}