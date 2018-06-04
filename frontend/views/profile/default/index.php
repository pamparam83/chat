<?php
use yii\helpers\Html;
use \yii\widgets\DetailView;


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php foreach ($users as $user):?>
        <?= Html::a(Html::encode($user->username),['/profile/info','id' => $user->id]);?><br>
    <?php endforeach;?>

    <!--    <h2>Attach profile</h2>-->
    <!--    --><?php //echo \yii\authclient\widgets\AuthChoice::widget([
    //        'baseAuthUrl' => ['cabinet/network/attach'],
    //    ])?>
</div>
