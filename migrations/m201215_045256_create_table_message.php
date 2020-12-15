<?php

use yii\db\Migration;

/**
 * Class m201215_045256_create_table_message
 */
class m201215_045256_create_table_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'message' => $this->text()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);
        $this->addForeignKey('fk_message_id', 'message', 'chat_id', 'chat', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_message_user_id', 'message', 'user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201215_045256_create_table_message cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201215_045256_create_table_message cannot be reverted.\n";

        return false;
    }
    */
}
