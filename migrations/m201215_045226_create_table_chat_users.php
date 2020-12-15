<?php

use yii\db\Migration;

/**
 * Class m201215_045226_create_table_chat_users
 */
class m201215_045226_create_table_chat_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat_user', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);
        $this->addForeignKey('fk_chat_id', 'chat_user', 'chat_id', 'chat', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_chat_user_id', 'chat_user', 'user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201215_045226_create_table_chat_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201215_045226_create_table_chat_users cannot be reverted.\n";

        return false;
    }
    */
}
