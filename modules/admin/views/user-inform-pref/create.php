<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserInformPref */

$this->title = 'Create User Inform Pref';
$this->params['breadcrumbs'][] = ['label' => 'User Inform Prefs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-inform-pref-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
