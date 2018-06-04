<?php
namespace frontend\controllers\cabinet;

use chat\repositories\MessageAssignmentRepository;
use chat\services\cabinet\FriendService;
use yii\filters\AccessControl;
use yii\web\Controller;
use chat\entities\User\User;
use Yii;
class DefaultController extends Controller
{
    public $service;
    public $message;
    public function __construct(string $id, $module,FriendService $service, MessageAssignmentRepository $message, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->service = $service;
        $this->message = $message;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $idUser = Yii::$app->user->id;
        $model = $this->findModel();
        $friends = $this->service->getAllFriends($idUser);
        $unread = $this->message->getCountUnread($idUser);
        $send = $this->message->getCountSend($idUser);
        $inbox = $this->message->getCountInbox($idUser);
        return $this->render('index',[
            'model' => $model,
            'friends' => $friends,
            'unread' => $unread,
            'send' => $send,
            'inbox' => $inbox,
        ]);
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}