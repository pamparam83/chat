<?php
namespace frontend\controllers\profile;

use chat\repositories\UserRepository;
use yii\filters\AccessControl;
use yii\web\Controller;
use chat\entities\User\User;
use Yii;
class DefaultController extends Controller
{
    private $_repository;
    public function __construct(string $id,$module, UserRepository $repository, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->_repository = $repository;
    }



    public function actionIndex()
    {
        $model = $this->_repository->getByAllUsers();
        return $this->render('index',[
            'users' => $model,
        ]);
    }


}