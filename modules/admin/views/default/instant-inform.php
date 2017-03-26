<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="page-header">
        <h1><?= $this->title ?></h1>
    </div>
    <div class="row inform_settings">
        <h4>Select types:</h4>
        <?php echo $form = Html::beginForm();
        foreach ($types as $type) {
            echo Html::checkbox('types[]', true, ['id' => $type->name, 'value' => $type->name]);
            echo Html::label($type->name, $type->name);
            echo "<br>";
        } ?>

        <h4>Select news:</h4>

        <?= Html::dropDownList('news_id', null, ArrayHelper::map($news, 'id', 'title')) ?>

        <br>
        <br>
        <h4>Select recipient:</h4>
        <?= Html::radio('recipients', true, ['value' => 'user', 'id' => 'radio_user']); ?>
        <?= Html::label('user', 'radio_user'); ?>
        <?= Html::dropDownList('user_id', null, ArrayHelper::map($users, 'id', 'username')) ?>
        <br>OR<br>
        <?= Html::radio('recipients', false, ['value' => 'role', 'id' => 'radio_role']); ?>
        <?= Html::label('role', 'radio_role'); ?>
        <?= Html::dropDownList('role', null, ArrayHelper::map($roles, 'name', 'name')) ?>
        <br>OR<br>
        <?= Html::radio('recipients', false, ['value' => 'all', 'id' => 'radio_all']); ?>
        <?= Html::label('all users', 'radio_all'); ?>

        <br>
        <br>
        <div class="form-group">
            <?= Html::submitButton('Inform', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= Html::endForm() ?>

    </div>
</div>