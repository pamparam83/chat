<?php


namespace chat\forms;


use chat\repositories\UserRepository;
use yii\base\Model;

class MessageForm extends Model
{

    public $text;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Text',
        ];
    }

    public function getAuthor($id)
    {
        $repository = new UserRepository();
        $user_id = \Yii::$app->user->id;
        if($user_id != $id){
            $author = $repository->get($id);
            return $author->username;
        }
        $author = $repository->get($user_id);
        return $author->username;
    }
}