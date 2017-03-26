<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_inform_pref`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `informtype`
 */
class m170324_102139_create_user_inform_pref_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_inform_pref', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'informtype_id' => $this->integer()->notNull(),
            'enabled' => $this->boolean(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_inform_pref-user_id',
            'user_inform_pref',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_inform_pref-user_id',
            'user_inform_pref',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `informtype_id`
        $this->createIndex(
            'idx-user_inform_pref-informtype_id',
            'user_inform_pref',
            'informtype_id'
        );

        // add foreign key for table `informtype`
        $this->addForeignKey(
            'fk-user_inform_pref-informtype_id',
            'user_inform_pref',
            'informtype_id',
            'informtype',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_inform_pref-user_id',
            'user_inform_pref'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_inform_pref-user_id',
            'user_inform_pref'
        );

        // drops foreign key for table `informtype`
        $this->dropForeignKey(
            'fk-user_inform_pref-informtype_id',
            'user_inform_pref'
        );

        // drops index for column `informtype_id`
        $this->dropIndex(
            'idx-user_inform_pref-informtype_id',
            'user_inform_pref'
        );

        $this->dropTable('user_inform_pref');
    }
}
