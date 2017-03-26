<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170322_221920_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'preview' => $this->text(),
            'content' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
