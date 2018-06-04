<?php

use yii\db\Migration;

/**
 * Class m180601_132120_update_name_user_table
 */
class m180601_132120_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%user}}','{{%users}}');
        $this->addColumn('{{%users}}', 'email_confirm_token',$this->string()->unique()->after('email'));
        $this->dropColumn('{{%users}}', 'username', $this->string());
        $this->dropColumn('{{%users}}', 'password_hash', $this->string());
        $this->dropColumn('{{%users}}', 'email', $this->string());
        $this->dropColumn('{{%users}}', 'active',$this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}','email_confirm_token');
        $this->dropColumn('{{%users}}', 'username');
        $this->dropColumn('{{%users}}', 'password_hash');
        $this->dropColumn('{{%users}}', 'email');
        $this->dropColumn('{{%users}}', 'active');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180601_132120_update_name_user_table cannot be reverted.\n";

        return false;
    }
    */
}
