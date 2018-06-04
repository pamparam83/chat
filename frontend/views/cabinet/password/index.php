<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'New password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cabinet-index">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Change password'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
