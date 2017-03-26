<?php
namespace tests\models;
use app\models\News;

class NewsTest extends \Codeception\Test\Unit
{
    function testNewsTitleCanBeChanged()
    {
        $news = News::findOne(1);
        $news->title = 'test';
        $news->save();
        $this->assertEquals('test', $news->title);
        expect($news->title)->equals('test');
        expect($news->title)->notEquals('test1');
    }
}
