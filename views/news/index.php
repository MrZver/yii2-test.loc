<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->user->can('moderator')) ? Html::a('Create News', ['create'], ['class' => 'btn btn-success']) : ''; ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => array_merge(
            [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'title',
                'created',
                'preview:ntext',
            ],
            ((!Yii::$app->user->isGuest) ? ['content:ntext'] : []),
            ((Yii::$app->user->can('moderator')) ? [['class' => 'yii\grid\ActionColumn']] : [])
        ),
    ]); ?>
</div>
