<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Informtype */

$this->title = 'Create Informtype';
$this->params['breadcrumbs'][] = ['label' => 'Informtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
