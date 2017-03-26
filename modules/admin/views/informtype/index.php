<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InformtypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informtypes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informtype-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Informtype', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p style="color: red">
        After creating here a new type, please setup logic, by adding new method to: 'app\components\Inform' with name equal to a new type.
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'message:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
