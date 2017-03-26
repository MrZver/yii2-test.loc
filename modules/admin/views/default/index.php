<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>

    <div class="col-md-3 col-sm-4">
        <div class="list-group">
            <?= Html::a('<i class="glyphicon glyphicon-chevron-right"></i>Rbac', ['/rbac'], ['class' => 'list-group-item']); ?>
            <?= Html::a('<i class="glyphicon glyphicon-chevron-right"></i>Users', ['/user/admin/index'], ['class' => 'list-group-item']); ?>
            <?= Html::a('<i class="glyphicon glyphicon-chevron-right"></i>Inform types', ['/admin/informtype'], ['class' => 'list-group-item']); ?>
            <?= Html::a('<i class="glyphicon glyphicon-chevron-right"></i>Inform manage', ['/admin/user-inform-pref'], ['class' => 'list-group-item']); ?>
            <?= Html::a('<i class="glyphicon glyphicon-chevron-right"></i>Instant inform', ['/admin/default/instant-inform'], ['class' => 'list-group-item']); ?>
        </div>
    </div>
</div>
