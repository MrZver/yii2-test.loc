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
    <div class="row">
        <?php foreach ($news as $cur_news) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="">
                    <?= Html::img("/images/no-image.jpg", ['alt'=>'', 'style'=>'height: 200px; width: 100%; display: block;']); ?>
                    <div class="caption">
                        <h3><?= Html::encode($cur_news->title) ?></h3>
                        <div class="date_created"><?= Html::encode($cur_news->created) ?></div>
                        <p><?= StringHelper::truncate(Html::encode($cur_news->preview), 150, '...');?></p>
                        <?= Html::a('Read >>', ['news', 'id' => $cur_news->id]) ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="text-center">
        <?php
        echo LinkPager::widget(['pagination' => $pagination]);
        ?>
    </div>
</div>