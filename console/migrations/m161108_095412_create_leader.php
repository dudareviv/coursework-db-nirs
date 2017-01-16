<?php

use yii\db\Migration;

class m161108_095412_create_leader extends Migration
{
    const LEADER = "leader";
    const USER = "user";

    public function safeUp()
    {
        $this->createTable(self::LEADER, [
            'user_id' => $this->integer()->unique(),
            'grade' => $this->string()->notNull(),//->comment('Степень')
        ]);

        $this->addForeignKey('leader__user', self::LEADER, 'user_id', self::USER, 'id');
    }

    public function safeDown()
    {
        $this->dropTable(self::LEADER);
    }
}