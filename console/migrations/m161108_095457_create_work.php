<?php

use yii\db\Migration;

class m161108_095457_create_work extends Migration
{
    const WORK = "work";
    const STUDENT = "student";
    const LEADER = "leader";

    public function safeUp()
    {
        $this->createTable(self::WORK, [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(),//->comment('Студент'),
            'leader_id' => $this->integer(),//->comment('Руководитель'),
            'theme' => $this->string()->notNull(),//->comment('Тема'),
            'justification' => $this->text()->notNull(),//->comment('Обоснование'),
        ]);

        $this->addForeignKey('work__student', self::WORK, 'student_id', self::STUDENT, 'user_id');
        $this->addForeignKey('work__leader', self::WORK, 'leader_id', self::LEADER, 'user_id');
    }

    public function safeDown()
    {
        $this->dropTable(self::WORK);
    }
}
