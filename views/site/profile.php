<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="page-header">
        <h1><?= $this->title ?></h1>
    </div>
    <div>username: <?= $user->username ?></div>
    <div>email: <?= $user->email ?></div>
    <div class="row inform_settings">
        <h3>Inform settings:</h3>
        <?php echo $form = Html::beginForm(null, null, ['id' => 'settings_form']);
        foreach ($types as $type) {
            echo Html::checkbox($type->name, (isset($defaults[$type->name])) ? $defaults[$type->name] : 0, ['id' => $type->name]);
            echo Html::label($type->name, $type->name);
            echo "<br>";
        } ?>

        <br>
        <div class="form-group">
            <?= Html::submitButton('Save profile', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= Html::endForm() ?>

    </div>
</div>