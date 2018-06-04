<?php
namespace frontend\controllers;

use chat\forms\MessageForm;
use chat\services\MessageService;
use Yii;
use chat\repositories\UserRepository;
use yii\web\Controller;

class ChatController extends Controller
{
    private $_repository;
    private $_service;

    public function __construct(string $id, $module, UserRepository $repository, MessageService $service,array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->_repository = $repository;
        $this->_service = $service;
    }

    public function actionIndex()
    {
        if(!\Yii::$app->user->isGuest){
            $users = $this->_repository->getUsersNotMy(\Yii::$app->user->id);
        }else {
            $users = $this->_repository->getByAllUsers();
        }
        return $this->render('index', ['users' => $users]);
    }

    public function actionMessage($id)
    {

        $form = new MessageForm();

        $messages = $this->_service->getAllMessage($id);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->_service->send($form,$id);
                return $this->redirect(['/chat/message', 'id' => $id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('message',[
            'model' => $form,
            'messages' => $messages,
        ]);
    }
}