<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Некорректные сообщение';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'message'],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model){
                    $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    return ($model->status == 0) ? '<a href="/message/set-correct?id='.$model->id.'&url='.base64_encode($link).'">Некорректно (Отменить)</a>' : '<a href="#">Корректно</a>';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
