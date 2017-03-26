<?php

use yii\bootstrap\Alert;

foreach(\Yii::$app->session->getAllFlashes() as $type => $messages):
    if (is_string($messages)) {
        $messages = [$messages];
    }
    ?>
    <?php foreach($messages as $message): ?>
        <?= Alert::widget([
            'options' => ['class' => 'alert-dismissible alert-' . $type],
            'body' => $message
        ]) ?>
    <?php endforeach ?>
<?php endforeach ?>