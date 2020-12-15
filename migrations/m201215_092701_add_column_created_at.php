<?php

use yii\db\Migration;

/**
 * Class m201215_092701_add_column_created_at
 */
class m201215_092701_add_column_created_at extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('message', 'created_at', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201215_092701_add_column_created_at cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201215_092701_add_column_created_at cannot be reverted.\n";

        return false;
    }
    */
}
