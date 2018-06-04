<?php
use yii\helpers\Html;
use \yii\widgets\DetailView;

$this->title = 'info';
$this->params['breadcrumbs'][] = ['label' => 'Chat', 'url' => ['/chat']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?php echo Html::encode($this->title . ' ' .$model->username); ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
            'active',
        ],
    ])?>
    <?php if (!Yii::$app->user->isGuest && !$friend) :?>
        <?= Html::a(Html::encode('add'),['/profile/info/add','id' => $model->id], ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    <?php endif;?>

</div>

