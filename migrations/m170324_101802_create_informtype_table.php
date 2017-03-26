<?php

use yii\db\Migration;

/**
 * Handles the creation of table `informtype`.
 */
class m170324_101802_create_informtype_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('informtype', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'message' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('informtype');
    }
}
