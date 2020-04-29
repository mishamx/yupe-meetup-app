<?php

use yii\db\Migration;

/**
 * Class m200429_181446_add_user
 */
class m200429_181446_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}',
            [
                'id'          => $this->primaryKey(),
                'login'     => $this->string()->notNull(),
                'password'       => $this->string()->notNull()
            ],
            $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable ('{{%user}}');
    }
    
}
