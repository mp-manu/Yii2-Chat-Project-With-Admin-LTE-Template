<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChatUser */

$this->title = 'Update Chat User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chat Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chat-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
