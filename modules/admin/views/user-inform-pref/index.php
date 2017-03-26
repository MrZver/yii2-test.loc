<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserInformPrefSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Inform Prefs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-inform-pref-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Inform Pref', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->username;
                }
            ],
//            'informtype_id',
            [
                'attribute' => 'informtype_id',
                'value' => function($data) {
                    return $data->informtype->name;
                }
            ],
//            'enabled',
            [
                'attribute' => 'enabled',
                'format' => 'raw',
                'value' => function($data) {
                    $statuses = [
                        '0' => '<span style="color: red;">Disabled</span>',
                        '1' => '<span style="color: green;">Enabled</span>',
                    ];
                    return $statuses[$data->enabled];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
