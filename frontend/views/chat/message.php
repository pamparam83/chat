<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-8">
        <h2>Messages</h2>
        <hr>
<!--        --><?php //var_dump($messages); exit;?>
        <?php if($messages): ?>
        <?php foreach ($messages as $message): ?>
            <div class="row">
                <div class="col-md-4"><?= $model->getAuthor($message['author']) ?>
                    <p><?= date('Y-m-d',$message['created_at']);?></p>
                </div>
                <div class="col-md-8"><?= Html::encode($message['text'])?></div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="col-md-4">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'text')->textarea(['rows' => 2]) ?>

        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
