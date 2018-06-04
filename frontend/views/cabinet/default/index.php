<?php
use yii\helpers\Html;
use \yii\widgets\DetailView;

$this->title = 'Personal info';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <p>
        <?= Html::a(Html::encode('Change password'),['/cabinet/password'])?>
    </p>

    <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
               'username',
               'email',
               'active'
            ],
    ])?>

    <div class="row">
        <div class="col-md-6">
            <h3>Friends</h3>
            <?php if ($friends): ?>
                <ul>
                    <?php foreach ($friends as $friend): ?>
                        <?= Html::tag('li', Html::encode($friend->username)) ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h4>Not friends!</h4>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h2>History</h2>
            <ul>
                <li>inbox | <?= $inbox ?></li>
                <li>sent | <?= $send ?></li>
                <li>Unread | <?= $unread ?></li>
            </ul>
        </div>

    </div>
<!--    <h2>Attach profile</h2>-->
<!--    --><?php //echo \yii\authclient\widgets\AuthChoice::widget([
//        'baseAuthUrl' => ['cabinet/network/attach'],
//    ])?>
</div>
