<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180603_075952_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'author' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%message_assignments}}', [
            'user_id' => $this->integer()->notNull(),
            'message_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'friend_id' => $this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-message_assignments}}', '{{%message_assignments}}', ['user_id', 'message_id']);

        $this->createIndex('{{%idx-message_assignments-user_id}}', '{{%message_assignments}}', 'user_id');
        $this->createIndex('{{%idx-message_assignments-message_id}}', '{{%message_assignments}}', 'message_id');

        $this->addForeignKey('{{%fk-message_assignments-user_id}}', '{{%message_assignments}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-message_assignments-message_id}}', '{{%message_assignments}}', 'message_id', '{{%messages}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%messages}}');
        $this->dropTable('{{%message_assignments}}');
    }
}
