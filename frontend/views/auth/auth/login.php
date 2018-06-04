<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-6">
        <h2>Новый клиент</h2>
        <p> <strong>Регистрация</strong> </p>
        <p>Создание учетной записи поможет покупать быстрее. Вы сможете контролировать состояние заказа, а также просматривать заказы сделанные ранее. Вы сможете накапливать призовые баллы и получать скидочные купоны. <br>А постоянным покупателям мы предлагаем гибкую систему скидок и персональное обслуживание.<br></p>
        <?= Html::a('Продолжить', ['/signup'],['class'=>'btn btn-primary']) ?> </div>
    <div class="col-sm-6">
        <h2>Авторизация</h2>
        <p> <strong>Я уже зарегистрирован</strong> </p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username')->textInput() ?>
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput() ?></div>
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Забыли пароль', ['auth/reset/request'],['class' => 'btn btn-warning']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
