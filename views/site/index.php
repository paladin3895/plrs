<?php

/* @var $this yii\web\View */
// use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\captcha\Captcha;

$this->title = 'Customer';
?>
<div class="site-index">

    <div class="jumbotron" style="margin-bottom: 0px">
        <h1>Welcome our beloved customer!</h1>

        <p class="lead">You can input your passcode here to view your medical records</p>
    </div>
        <div class="col-lg-4 col-lg-offset-4">
            <?php $form = ActiveForm::begin([
                'id' => 'auth-form', 'class' => 'form-signin',
                'method' => 'POST',
                'action' => Url::to('/customer-report/auth')
            ]); ?>

                <?= $form->field($model, 'name')->widget(
                    AutoComplete::classname(),
                    [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $patientNames,
                        ]
                    ]) ?>

                <?= $form->field($model, 'passcode')->passwordInput() ?>

                <!-- $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) -->

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'auth-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div></div>
</div>
