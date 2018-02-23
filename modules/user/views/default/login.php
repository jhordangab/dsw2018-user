<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Acesso ao Sistema';

$css = <<<CSS
        
    .help-block-error
    {
        color: rgb(236, 101, 101);
        font-size: 12px;
        text-align: center;
        margin: 5px; 
    }
        
CSS;

$this->registerCss($css);

if($errors)
{
    foreach($errors as $error)
    {
        $str_error = (is_array($error)) ? $error[0] : $error;
        $js = <<<JS
        
    iziToast.error({
        title: 'Error',
        message: '{$str_error}',
        position: 'topCenter',
        close: true,
        transitionIn: 'flipInX',
        transitionOut: 'flipOutX',
    });
        
    $('.form-group').addClass('has-danger');
JS;

    $this->registerJs($js);
    }
}

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <?= Html::img('@web/img/logo.png', ['alt' => Yii::$app->name, 'style' => 'width: 200px; margin-left: auto; margin-right: auto;', 'class' => 'img-responsive']) ?>
    </div>

    <div class="login-box-body">
        
        <p class="login-box-msg">Login</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => 'Usuário']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">

            <div class="col-xs-12">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-block btn-flat', 'name' => 'login-button', 'style' => 'background-color: #6abd24; border-color: #6abd24; color: #fff;']) ?>
            </div>

        </div>
        
        <?php ActiveForm::end(); ?>
        
    </div>

</div>