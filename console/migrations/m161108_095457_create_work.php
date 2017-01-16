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
            'student_id' => $this->integer()->notNull(),//->comment('Студент'),
            'leader_id' => $this->integer()->notNull(),//->comment('Руководитель'),
            'theme' => $this->string()->notNull(),//->comment('Тема'),
            'justification' => $this->text()->notNull(),//->comment('Обоснование'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),//->comment('Статус'),
        ]);

        $this->addForeignKey('work__student', self::WORK, 'student_id', self::STUDENT, 'id');
        $this->addForeignKey('work__leader', self::WORK, 'leader_id', self::LEADER, 'id');
    }

    public function safeDown()
    {
        $this->dropTable(self::WORK);
    }
}
