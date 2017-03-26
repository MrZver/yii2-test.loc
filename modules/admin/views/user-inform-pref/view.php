<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserInformPref */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Inform Prefs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-inform-pref-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->username;
                }
            ],
            [
                'attribute' => 'informtype_id',
                'value' => function($data) {
                    return $data->informtype->name;
                }
            ],
            [
                'attribute' => 'enabled',
                'value' => function($data) {
                    $statuses = [
                        '0' => 'Disabled',
                        '1' => 'Enabled',
                    ];
                    return $statuses[$data->enabled];
                }
            ],
        ],
    ]) ?>

</div>
