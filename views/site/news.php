<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;

?>
<div class="site-index">

    <div class="page-header">
        <h1><?= $this->title ?></h1>
    </div>
    <div class="media">
        <div class="media-left">
            <a href="#">
                <?= Html::img("/images/no-image.jpg", ['alt'=>'', 'style'=>'width: 300px; display: block;']); ?>
            </a>
        </div>
        <div class="media-body">
            <h3 class="media-heading"><?= $news->title ?></h3>
            <div class="date_created"><?= Html::encode($news->created) ?></div>
            <?= Html::encode($news->content);?>
            <br>
            <?= Html::a('<< back', '/') ?>
        </div>
    </div>
</div>