<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserInformPref */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-inform-pref-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username')); ?>

    <?= $form->field($model, 'informtype_id')->dropDownList(ArrayHelper::map(\app\models\Informtype::find()->all(), 'id', 'name')); ?>

    <?= $form->field($model, 'enabled')->dropDownList([
        '0' => 'Disabled',
        '1' => 'Enabled',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
