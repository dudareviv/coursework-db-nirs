<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    const USER = 'user';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if ($this->db->driverName === 'mssql') {
            $sql = 'ALTER DATABASE nirs COLLATE SQL_Latin1_General_CP1_CI_AS'; //UCS-2
            $this->execute($sql);
        }

        $this->createTable(self::USER, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),

            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::USER);
    }
}
