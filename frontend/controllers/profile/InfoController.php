<?php
namespace frontend\controllers\profile;

use chat\repositories\UserRepository;
use Yii;
use chat\services\cabinet\FriendService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class InfoController extends Controller
{
    private $_repository;
    public $service;
    public function __construct(string $id,$module, UserRepository $repository, FriendService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->_repository = $repository;
        $this->service = $service;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add'],
                'rules' => [

                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add' => ['get'],
                ],
            ],
        ];
    }

    public function actionIndex($id)
    {
        $model = $this->_repository->get($id);
        $friend = $this->service->isFriend(Yii::$app->user->id,$id);
        return $this->render('index',[
            'model' => $model,
            'friend' => $friend,
        ]);
    }

    public function actionAdd($id)
    {
        $friend = $this->_repository->get($id);
        try {
            $this->service->attach(Yii::$app->user->id, $friend->id);
            Yii::$app->session->setFlash('success', 'Friend is successfully attached.');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['/chat']);
    }
}