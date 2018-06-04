<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friends`.
 */
class m180602_075848_create_friends_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%friends}}', [
            'user_id' => $this->integer()->notNull(),            
            'friend_id' => $this->integer()->notNull(),            
        ]);

        $this->createIndex('{{%idx-friends}}', '{{%friends}}', ['user_id', 'friend_id'], true);

        $this->createIndex('{{%idx-friends-user_id}}', '{{%friends}}', 'user_id');

        $this->addForeignKey('{{%fk-friends-user_id}}', '{{%friends}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('friends');
    }
}
