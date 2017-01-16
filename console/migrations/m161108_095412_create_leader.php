<?php

use yii\db\Migration;

class m161108_095412_create_leader extends Migration
{
    const LEADER = "leader";
    const USER = "user";

    public function safeUp()
    {
        $this->createTable(self::LEADER, [
            'id' => $this->primaryKey(),
            'last_name' => $this->string()->notNull(),//->comment('Фамилия'),
            'first_name' => $this->string()->notNull(),//->comment('Имя'),
            'parent_name' => $this->string()->notNull(),//->comment('Отчество'),
            'grade' => $this->string()->notNull(),//->comment('Степень')
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::LEADER);
    }
}