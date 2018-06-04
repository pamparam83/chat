<?php
use yii\helpers\Html;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php foreach ($users as $user):?>
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-6"><?= Html::a(Html::encode($user->username),['/profile/info','id' => $user->id]);?></div>
                <div class="col-md-6">
                    <?php if(!Yii::$app->user->isGuest): ?>
                    <?php echo Html::a('message',['/chat/message','id' => $user->id]) ?>
                    <?php else:?>
                     SignUp or Login
                    <?php endif; ?>
                </div>
            </div>
            <hr>
        </div>
    <?php endforeach;?>

</div>
