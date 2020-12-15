<?php

use yii\db\Migration;

/**
 * Class m201215_045214_create_table_chat
 */
class m201215_045214_create_table_chat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200),
            'type' => $this->tinyInteger(),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201215_045214_create_table_chat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201215_045214_create_table_chat cannot be reverted.\n";

        return false;
    }
    */
}
