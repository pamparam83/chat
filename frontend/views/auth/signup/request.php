<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \chat\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title);?></h1>
<p>Если Вы уже зарегистрированы, перейдите на страницу <a href="/login">авторизации</a>.</p>
<?php $form = ActiveForm::begin([
    'id' => 'form-signup',
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n<div class=\"col-sm-10\">{input}</div>\n{hint}\n{error}\n{endWrapper}",
        'labelOptions' => ['class' => 'col-sm-4 control-label'],
        'horizontalCssClasses' => [
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>
<fieldset id="account">
    <legend>Заполните форму</legend>
    <div class="form-group required" style="display:  none ;">
        <label class="col-sm-2 control-label">Категория</label>
        <div class="col-sm-10">
            <div class="radio">
                <label>
                    <input type="radio" name="customer_group_id" value="1" checked="checked" />
                    Физ.лицо</label>
            </div>
        </div>
    </div>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Введите логин']) ?>



    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Введите Email']) ?>

</fieldset>
<fieldset>
    <legend>Ваш пароль</legend>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль']) ?>
    <?= $form->field($model, 'passwordConfirm')->passwordInput(['placeholder' => 'Подтверждение пароля']) ?>
</fieldset>


<div class="buttons">
    <div class="pull-right">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>



