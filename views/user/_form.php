<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
            <div class="col-md-6"> <?= $form->field($model, 'fio')->textInput() ?></div>
            <div class="col-md-6"> <?= $form->field($model, 'user_type')->dropDownList([ 'admin' => 'Admin', 'user' => 'User', 'guest' => 'Guest', ], ['prompt' => '']) ?></div>
    </div>
    <div class="row">
        <div class="col-md-6"> <?= $form->field($model, 'telefon')->textInput() ?></div>
        <div class="col-md-6"> <?= $form->field($model, 'email')->textInput() ?></div>
    </div>
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'user_password')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
