<?php

function dump($var)
{
    yii\helpers\VarDumper::dump($var, 10, true);
}

function dd($var)
{
    yii\helpers\VarDumper::dump($var, 10, true);
    Yii::$app->end();
}