<?php

use yii\db\Migration;

/**
 * Handles adding created to table `news`.
 */
class m170324_071015_add_created_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'created', $this->timestamp());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'created');
    }
}
